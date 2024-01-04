/*
 Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
(function(){function z(b){return CKEDITOR.env.ie?b.$.clientWidth:parseInt(b.getComputedStyle("width"),10)}function u(b,d){var a=b.getComputedStyle("border-"+d+"-width"),h={thin:"0px",medium:"1px",thick:"2px"};0>a.indexOf("px")&&(a=a in h&&"none"!=b.getComputedStyle("border-style")?h[a]:0);return parseFloat(a)}function C(b){var d=[],a={},h="rtl"===b.getComputedStyle("direction"),l=CKEDITOR.tools.array.zip((new CKEDITOR.dom.nodeList(b.$.rows)).toArray(),CKEDITOR.tools.buildTableMap(b));CKEDITOR.tools.array.forEach(l,
function(e){var c=e[0].$;e=e[1];var l=-1,g=0,f=null;c?(g=new CKEDITOR.dom.element(c),f={height:g.$.offsetHeight,position:g.getDocumentPosition()}):f=void 0;for(var c=CKEDITOR.env.ie&&!CKEDITOR.env.edge,m="collapse"===b.getComputedStyle("border-collapse"),g=f.height,f=f.position,p=0;p<e.length;p++){var k=new CKEDITOR.dom.element(e[p]),v=e[p+1]&&new CKEDITOR.dom.element(e[p+1]),q,w,r=k.getDocumentPosition().x,l=l+(k.$.colSpan||1);h?w=r+u(k,"left"):q=r+k.$.offsetWidth-u(k,"right");v?(r=v.getDocumentPosition().x,
h?q=r+v.$.offsetWidth-u(v,"right"):w=r+u(v,"left")):(r=b.getDocumentPosition().x,h?q=r:w=r+b.$.offsetWidth);k=Math.max(w-q,3);c&&m&&(q-=k,k=Math.max(w-q,3));k={table:b,index:l,x:q,y:f.y,width:k,height:g,rtl:h};a[l]=a[l]||[];a[l].push(k);k.alignedPillars=a[l];d.push(k)}});return d}function B(b){(b.data||b).preventDefault()}function E(b){function d(){f=0;g.setOpacity(0);p&&a();var b=c.table;setTimeout(function(){b.removeCustomData("_cke_table_pillars")},0);n.removeListener("dragstart",B)}function a(){for(var l=
c.rtl,a=l?q.length:v.length,g=0,e=0;e<a;e++){var f=v[e],d=q[e],k=c.table;CKEDITOR.tools.setTimeout(function(c,e,f,d,n,h){c&&c.setStyle("width",m(Math.max(e+h,1)));f&&f.setStyle("width",m(Math.max(d-h,1)));n&&k.setStyle("width",m(n+h*(l?-1:1)));++g==a&&b.fire("saveSnapshot")},0,this,[f,f&&z(f),d,d&&z(d),(!f||!d)&&z(k)+u(k,"left")+u(k,"right"),p])}}function h(a){B(a);b.fire("saveSnapshot");a=c.index;for(var d=CKEDITOR.tools.buildTableMap(c.table),k=[],h=[],m=Number.MAX_VALUE,u=m,y=c.rtl,D=0,C=d.length;D<
C;D++){var t=d[D],x=t[a+(y?1:0)],t=t[a+(y?0:1)],x=x&&new CKEDITOR.dom.element(x),t=t&&new CKEDITOR.dom.element(t);x&&t&&x.equals(t)||(x&&(m=Math.min(m,z(x))),t&&(u=Math.min(u,z(t))),k.push(x),h.push(t))}v=k;q=h;w=c.x-m;r=c.x+u;g.setOpacity(.5);A=parseInt(g.getStyle("left"),10);p=0;f=1;g.on("mousemove",e);n.on("dragstart",B);n.on("mouseup",l,this)}function l(c){c.removeListener();d()}function e(c){k(c.data.getPageOffset().x)}var c,n,g,f,A,p,k,v,q,w,r;n=b.document;g=CKEDITOR.dom.element.createFromHtml('\x3cdiv data-cke-temp\x3d1 contenteditable\x3dfalse unselectable\x3don style\x3d"position:absolute;cursor:col-resize;filter:alpha(opacity\x3d0);opacity:0;padding:0;background-color:#004;background-image:none;border:0px none;z-index:10000"\x3e\x3c/div\x3e',
n);b.on("destroy",function(){g.remove()});y||n.getDocumentElement().append(g);this.attachTo=function(b){var a,l,e;f||(y&&(n.getBody().append(g),p=0),c=b,a=c.alignedPillars[0],l=c.alignedPillars[c.alignedPillars.length-1],e=a.y,a=l.height+l.y-a.y,g.setStyles({width:m(b.width),height:m(a),left:m(b.x),top:m(e)}),y&&g.setOpacity(.25),g.on("mousedown",h,this),n.getBody().setStyle("cursor","col-resize"),g.show())};k=this.move=function(a,b){if(!c)return 0;if(!(f||a>=c.x&&a<=c.x+c.width&&b>=c.y&&b<=c.y+c.height))return c=
null,f=p=0,n.removeListener("mouseup",l),g.removeListener("mousedown",h),g.removeListener("mousemove",e),n.getBody().setStyle("cursor","auto"),y?g.remove():g.hide(),0;var d=a-Math.round(g.$.offsetWidth/2);if(f){if(d==w||d==r)return 1;d=Math.max(d,w);d=Math.min(d,r);p=d-A}g.setStyle("left",m(d));return 1}}function A(b){var d=b.data.getTarget();if("mouseout"==b.name){if(!d.is("table"))return;for(var a=new CKEDITOR.dom.element(b.data.$.relatedTarget||b.data.$.toElement);a&&a.$&&!a.equals(d)&&!a.is("body");)a=
a.getParent();if(!a||a.equals(d))return}d.getAscendant("table",1).removeCustomData("_cke_table_pillars");b.removeListener()}var m=CKEDITOR.tools.cssLength,y=CKEDITOR.env.ie&&(CKEDITOR.env.ie7Compat||CKEDITOR.env.quirks);CKEDITOR.plugins.add("tableresize",{requires:"tabletools",init:function(b){b.on("contentDom",function(){var d,a=b.editable(),h=a.isInline()?a:b.document;a.attachListener(h,"mousemove",function(a){a=a.data;var e=a.getTarget();if(e.type==CKEDITOR.NODE_ELEMENT){var c=a.getPageOffset().x,
h=a.getPageOffset().y;if(d&&d.move(c,h))B(a);else if(e.is("table")||e.getAscendant({thead:1,tbody:1,tfoot:1},1))if(a=e.getAscendant("table",1),b.editable().contains(a)){(e=a.getCustomData("_cke_table_pillars"))||(a.setCustomData("_cke_table_pillars",e=C(a)),a.on("mouseout",A),a.on("mousedown",A));a:{a=e;for(var e=0,g=a.length;e<g;e++){var f=a[e];if(c>=f.x&&c<=f.x+f.width&&h>=f.y&&h<=f.y+f.height){c=f;break a}}c=null}c&&(!d&&(d=new E(b)),d.attachTo(c))}}});a.attachListener(h,"scroll",function(){var b=
a.find("table").toArray();CKEDITOR.tools.array.forEach(b,CKEDITOR.tools.debounce(function(a){a.removeCustomData("_cke_table_pillars")},200))})})}})})();