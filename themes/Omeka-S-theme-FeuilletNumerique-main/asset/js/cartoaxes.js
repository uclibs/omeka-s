/*!
 * cartoaxes v0.0.1 
 * Copyright 2020 Samuel Szoniecky
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
class cartoaxes {
    constructor(params) {
        var me = this;
        this.data = [];
        this.titre = params.titre ? params.titre : '';
        this.crible = params.crible ? params.crible : [{
            'label': 'clair',
            'id': '0',
            'idP': '0'
        }, {
            'label': 'obscur',
            'id': '1',
            'idP': '0'
        }, {
            'label': 'pertinent',
            'id': '2',
            'idP': '0'
        }, {
            'label': 'inadapté',
            'id': '3',
            'idP': '0'
        }];
        this.urlData = params.urlData ? params.urlData : false;
        this.fctCallBackInit = params.fctCallBackInit ? params.fctCallBackInit : false;
        this.svg = d3.select("#" + params.idSvg),
            this.width = params.width ? params.width : this.svg.attr("width"),
            this.height = params.height ? params.height : this.svg.attr("height"),
            this.xMin = params.xMin ? params.xMin : 0;
        this.xMax = params.xMax ? params.xMax : 100;
        this.yMin = params.yMin ? params.yMin : 0;
        this.yMax = params.yMax ? params.yMax : 100;
        this.colorFond = params.colorFond ? params.colorFond : "transparent";
        this.tick = params.tick ? params.tick : 0;
        this.rayons = d3.range(params.nbRayon ? params.nbRayon : 6); // Création d'un tableau pour les rayons des cercles
        this.fctGetGrad = params.fctGetGrad ? params.fctGetGrad : false;
        this.fctSavePosi = params.fctSavePosi ? params.fctSavePosi : false;
        this.idDoc = params.idDoc ? params.idDoc : false;
        this.typeSrc = params.typeSrc ? params.typeSrc : false;
        this.hasRatingSystem = params.hasRatingSystem ? params.hasRatingSystem : false;

        //variable pour les axes
        var labelFactor = 1, //How much farther than the radius of the outer circle should the labels be placed
            marges = {
                'top': 10
            },
            radius = Math.min(this.width / 2, (this.height - marges.top) / 2),
            angleSlice = Math.PI * 2 / this.crible.length,
            scCircle = d3.scalePoint()
            .domain(this.rayons)
            .range([0, radius]),
            //variables pour les débgradés
            svgDefs, degrad,
            //drag variables
            onDrag = true,
            svgDrag,
            //distance variable
            pointCentral,
            tooltip, fontSize = 16;

        //création des dégradé
        svgDefs = this.svg.append('defs');


        let lg = svgDefs.append('linearGradient')
            .attr('id', "degraxeH")
            .attr('x1', "0%")
            .attr('y1', "0%")
            .attr('x2', "0%")
            .attr('y2', "100%")
        lg.append('stop').attr('offset', "5%").attr('stop-color', "rgb(173, 158, 253)")
        lg.append('stop').attr('offset', "95%").attr('stop-color', "rgb(252, 161, 205)")
        lg = svgDefs.append('linearGradient')
            .attr('id', "degraxeV")
            .attr('x1', "0%")
            .attr('y1', "0%")
            .attr('x2', "100%")
            .attr('y2', "0%")
        lg.append('stop').attr('offset', "0%").attr('stop-color', "rgb(3, 246, 162)")
        lg.append('stop').attr('offset', "100%").attr('stop-color', "rgb(84, 214, 255)")

        lg = svgDefs.append('linearGradient')
            .attr('id', "degradCenter")
            .attr('x1', "0.717")
            .attr('y1', "1")
            .attr('x2', "0")
            .attr('y2', "1")
            .attr('gradientUnits', "objectBoundingBox")
        lg.append('stop').attr('offset', "0").attr('stop-color', "#5ffd8a")
        lg.append('stop').attr('offset', "0.65").attr('stop-color', "#58e6ce")
        lg.append('stop').attr('offset', "1").attr('stop-color', "#55daf2")


        //positionnement du graphique
        this.transform = params.transform ? params.transform : "translate(" + me.width / 2 + ',' + me.height / 2 + ") scale(0.9)";
        this.g = this.svg.append("g")
            .attr("class", "cartoaxes")
            .attr("transform", this.transform);
        //calcule des échelles
        this.x = d3.scaleLinear()
            .domain(padExtent([this.xMin, this.xMax]))
            .range(padExtent([0, this.width]));
        this.y = d3.scaleLinear()
            .domain(padExtent([this.yMin, this.yMax]))
            .range(padExtent([this.height - marges.top, 0]));
        this.rScale = d3.scaleLinear()
            .range([0, radius])
            .domain([this.xMin, this.xMax]);
        this.vScale = d3.scaleLinear()
            .range([0, 100])
            .domain([0, radius]);

        this.init = function () {


            me.g.append("rect")
                .attr("width", me.width)
                .attr("height", me.height)
                .attr("fill", me.colorFond)
                .on('mousemove', function (e) {
                    /*
                    console.log(d3.mouse(this)[0]);
                    console.log(me.x.invert(d3.mouse(this)[0]));
                    console.log(me.y.invert(d3.mouse(this)[1]));
                    */
                });

            me.drawAxes();
            me.drawCible();
            me.drawData();

            //Ajoute le titre de la carto
            me.g.append("text")
                .attr("class", "txtTitreAxehaut")
                .style("font-size", "18px")
                .style("font-style", "italic")
                .attr("text-anchor", "middle")
                .attr("x", 0)
                .attr("y", -(me.height / 2) - (marges.top / 2))
                .text(me.titre);

            //ajout du tooltip
            d3.select(".tooltipCartoAxes").remove();
            tooltip = d3.select("body").append("div")
                .attr("class", "tooltipCartoAxes")
                .style('position', 'absolute')
                .style('padding', '4px')
                .style('background-color', 'black')
                .style('color', 'white')
                .style('pointer-events', 'none');


        };


        function showTooltip(e, d) {
            //calcule les élément du tooltip
            console.log(d);
            const event = new Date(d["o:created"]["@value"]);
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            tooltip.html("<h3>" + d["jdc:hasActant"][0].display_title + "</h3>" +
                    "<h4>" + event.toLocaleDateString('fr-FR', options) + " " + event.toLocaleTimeString('fr-FR') + "</h4>"
                )
                .style("display", "block")
                .style("left", (e.pageX) + "px")
                .style("top", (e.pageY) + "px");
        }

        function hideTooltip() {
            tooltip.style("display", "none");
        }


        function getTextWidth(text, font = fontSize + "px Times New Roman") {
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            context.font = font;
            return context.measureText(text).width;
        }

        function breakString(word, maxWidth, hyphenCharacter = '-') {
            const characters = word.split("");
            const lines = [];
            let currentLine = "";
            characters.forEach((character, index) => {
                const nextLine = `${currentLine}${character}`;
                const lineWidth = getTextWidth(nextLine);
                if (lineWidth >= maxWidth) {
                    const currentCharacter = index + 1;
                    const isLastLine = characters.length === currentCharacter;
                    const hyphenatedNextLine = `${nextLine}${hyphenCharacter}`;
                    lines.push(isLastLine ? nextLine : hyphenatedNextLine);
                    currentLine = "";
                } else {
                    currentLine = nextLine;
                }
            });
            return {
                hyphenatedStrings: lines,
                remainingWord: currentLine
            };
        }

        function wrapLabel(label, maxWidth) {
            if (!label) return [];
            const words = label.split(" ");
            const completedLines = [];
            let nextLine = "";
            words.forEach((word, index) => {
                const wordLength = getTextWidth(`${word} `);
                const nextLineLength = getTextWidth(nextLine);
                if (wordLength > maxWidth) {
                    const {
                        hyphenatedStrings,
                        remainingWord
                    } = breakString(word, maxWidth);
                    completedLines.push(nextLine, ...hyphenatedStrings);
                    nextLine = remainingWord;
                } else if (nextLineLength + wordLength >= maxWidth) {
                    completedLines.push(nextLine);
                    nextLine = word;
                } else {
                    nextLine = [nextLine, word].filter(Boolean).join(" ");
                }
                const currentWord = index + 1;
                const isLastWord = currentWord === words.length;
                if (isLastWord) {
                    completedLines.push(nextLine);
                }
            });
            return completedLines.filter(line => line !== "");
        }

        // Fonction pour créer la cible
        this.drawCible = function (d) {
            //ajoute les cercles concentriques
            //le cercle 0 sert de point central pour la distance
            //le cercle 1 sert de curseur d'intensité
            me.g.selectAll('.cFond').data(me.rayons).enter().append('circle') // Création des cercles + attributs
                .attr('class', 'cFond')
                .attr('id', function (d, i) {
                    return 'orbit' + i;
                })
                .attr('r', function (d) {
                    //on affiche ni le premier ni le dernier
                    let r = scCircle(d)
                    if (d == 0) r = 0;
                    if (d == 1) r = scCircle(d) / 2;
                    if (d == me.rayons.length - 1) r = 0;
                    return r;
                })
                .attr('cx', 0)
                .attr('cy', 0);
            d3.select("#orbit1").call(me.drag);
            let center = d3.select("#orbit1").node();
            pointCentral = {
                'X': center.getAttribute("cx"),
                'Y': center.getAttribute("cy")
            };

        }

        // Fonction pour créer les axes
        this.drawAxes = function (d) {

            //Create the straight lines radiating outward from the center
            var axis = me.g.selectAll(".axis")
                .data(me.crible)
                .enter()
                .append("g")
                .attr("class", "axis");
            //Append the lines
            axis.append("line")
                .attr("x1", 0)
                .attr("y1", 0)
                .attr("x2", function (d, i) {
                    d.x = me.rScale(me.xMax * labelFactor) * Math.cos(angleSlice * i - Math.PI / 2);
                    d.x2 = me.rScale(me.xMax - 10) * Math.cos(angleSlice * i - Math.PI / 2);
                    return d.x2;
                })
                .attr("y2", function (d, i) {
                    d.y = me.rScale(me.xMax * labelFactor) * Math.sin(angleSlice * i - Math.PI / 2);
                    d.y2 = (me.rScale(me.xMax - 10) * Math.sin(angleSlice * i - Math.PI / 2)) + 1;
                    return d.y2;
                });

            //Append the labels at each axis
            let txt = axis.append("text")
                .attr("class", "txtTitreAxehaut")
                //.style("font-size", "11px")
                .attr("text-anchor", "middle");
            txt.selectAll("tspan")
                .data((d,i) => {
                    d.wl = wrapLabel(d.label, me.xMax*1.5)
                    return d.wl;
                })
                .join("tspan")
                .text(d => d);
            
            //modifient les éléments suite au wrap            
            txt.attr('transform',d=>{
                return `translate(${d.x},${d.y})`;
            });
            txt.selectAll("tspan")
                .attr("x", 3)
                .attr("y", (d, i, nodes) => `${(i === nodes.length - 1) * 0.3 + 1.1 + i * 0.9}em`);

            /*    
            axis.append("text")
                .attr("class", "txtTitreAxehaut")
                //.style("font-size", "11px")
                .attr("text-anchor", "middle")
                .attr("dy", function (d, i) {
                    return i == 0 ? "1.2em" : "";
                })
                .attr("x", function (d, i) {
                    return me.rScale(me.xMax * labelFactor) * Math.cos(angleSlice * i - Math.PI / 2);
                })
                .attr("y", function (d, i) {
                    return me.rScale(me.xMax * labelFactor) * Math.sin(angleSlice * i - Math.PI / 2);
                })
                .text(function (d) {
                    return d.label;
                });
            */
        }

        // Fonction pour l'event "drag" d3js
        this.dragstarted = function (e, d) {
            //on ne peut déplacer que le cercle 1
            if (d != 1) return;
            me.setSvgDrag([e.x, e.y]);
            d3.select(this).raise().classed("active", true);
            me.onDrag = true;
        }

        this.dragged = function (e, d) {
            //console.log(me.width+','+me.height+' : '+d3.event.x+','+d3.event.y);
            //pour limiter le drag
            //if(d3.event.x < me.width && d3.event.x > 0 && d3.event.y < me.height && d3.event.y > 0)
            svgDrag.attr("cx", e.x).attr("cy", e.y);
        }

        this.dragended = function (e, d) {
            //récupère les données du points
            let posi = [e.x, e.y];
            //calcule la distance et la pondération du crible
            let v = me.getValorisation(posi[0], posi[1]);
            //formate les données
            let r = {
                'x': posi[0],
                'y': posi[1],
                'numX': me.x.invert(posi[0]),
                'numY': me.y.invert(posi[1]),
                'degrad': degrad //récupère les couleurs et la date
                    ,
                'distance': v.d,
                'crible': v.s,
                'id': me.idDoc,
                'infos': me.data
            };
            console.log(r);
            if (me.fctSavePosi) me.fctSavePosi(r);
        }

        this.setSvgDrag = function (p) {
            //console.log(p);
            let c = me.getGradient();
            svgDrag = me.g.append("circle")
                .attr('class', 'evals')
                .attr('r', scCircle.step() / 3)
                .attr('cx', p[0])
                .attr('cy', p[1])
                .attr('fill', c)
                .attr('stroke', 'black')
                .attr("stroke-width", '1');
        }

        this.drag = d3.drag()
            .on("start", me.dragstarted)
            .on("drag", me.dragged)
            .on("end", me.dragended);

        this.drawData = function () {
            if (me.urlData) {
                //cherche sur le serveur les évaluations existantes
                mdPatienter.show();
                $.get(me.urlData, {}, function (data) {
                        me.drawPosi(data);
                    }, "json")
                    .fail(function (e) {
                        throw new Error("Chargement des données imposible : " + e);
                    })
                    .always(function () {
                        mdPatienter.close();
                    });
            }

        };

        this.drawPosi = function (data) {
            //enlève les anciennes évaluations
            me.g.selectAll(".evals").remove();
            //ajoute toutes les évaluations
            me.g.selectAll(".evals")
                .data(data)
                .enter().append("circle")
                .attr("class", "evals")
                .attr('r', scCircle.step() / 3)
                .attr('cx', function (d) {
                    //return me.x(d.valeur.numX); 
                    return me.x(parseFloat(d['jdc:xRatingValue'][0]['@value']));
                })
                .attr('cy', function (d) {
                    //return me.y(d.valeur.numY); 
                    return me.y(parseFloat(d['jdc:yRatingValue'][0]['@value']));
                })
                .attr('fill', function (d) {
                    d.degrad = {
                        'nom': d['jdc:degradName'][0]['@value'],
                        'colors': []
                    }
                    d['jdc:degradColors'].forEach(function (c) {
                        d.degrad.colors.push(c['@value']);
                    });
                    return me.setGradient(d.degrad);
                })
                .attr('stroke', 'black')
                .attr("stroke-width", '1')
                .on('mouseenter', showTooltip)
                .on('mouseleave', hideTooltip);
        }

        function padExtent(e, p) {
            if (p === undefined) p = 1;
            return ([e[0] - p, e[1] + p]);
        }

        this.getGradient = function () {
            if (!me.fctGetGrad) return 'white';
            degrad = me.fctGetGrad();

            return me.setGradient(degrad);
        }

        this.setGradient = function (degrad) {

            if (!document.getElementById(degrad.nom)) {
                var radialG = svgDefs.append('radialGradient')
                    .attr('id', degrad.nom);

                // Create the stops of the main gradient. Each stop will be assigned
                radialG.selectAll('stop').data(degrad.colors).enter().append('stop')
                    .attr('stop-color', function (d) {
                        return d;
                    })
                    .attr('offset', function (d, i) {
                        let pc = 100 / degrad.colors.length * i;
                        return pc + '%';
                    });
            }
            return "url(#" + degrad.nom + ")";
        }


        // Credits goes to Stackoverflow: http://stackoverflow.com/a/14413632
        this.getAngleFromPoint = function (point1, point2) {
            var dy = (point1.Y - point2.Y),
                dx = (point1.X - point2.X);
            var theta = Math.atan2(dy, dx);
            var angle = (((theta * 180) / Math.PI)) % 360;
            angle = (angle < 0) ? 360 + angle : angle;
            return angle;
        }
        // Credits goes to http://snipplr.com/view/47207/
        this.getDistance = function (point1, point2) {
            var xs = 0;
            var ys = 0;

            xs = point2.X - point1.X;
            xs = xs * xs;

            ys = point2.Y - point1.Y;
            ys = ys * ys;

            return Math.sqrt(xs + ys);
        }

        //credit goes to https://codepen.io/netsi1964/pen/WrRGoo
        this.getValorisation = function (x, y) {
            let angle = Math.round(100 * me.getAngleFromPoint({
                'X': x,
                'Y': y
            }, pointCentral)) / 100;
            let distance = Math.round(me.getDistance({
                'X': x,
                'Y': y
            }, pointCentral));
            let angleAxe = 0;
            let valo = [];
            //pondération du crible
            //0 de crible = 270 angle
            me.crible.forEach(function (s, i) {
                angleAxe = angleSlice * i * (180 / Math.PI);
                angleAxe = angleAxe >= 90 ? angleAxe - 90 : angleAxe + 270;
                valo.push({
                    't': s,
                    'p': angle - angleAxe
                });
            })
            return {
                's': valo,
                'd': me.vScale(distance)
            };
        }
        this.init();
    }
}