if (!ThanksRoy) {
    var ThanksRoy = {};
}

if (!Omeka) {
    var Omeka = {};
}

(function($) {

    ThanksRoy.megaMenu = function (menuSelector, customMenuOptions) {
        if (typeof menuSelector === 'undefined') {
            menuSelector = '#primary-nav';
        }

        var menuOptions = {
            /* prefix for generated unique id attributes, which are required
             to indicate aria-owns, aria-controls and aria-labelledby */
            uuidPrefix: "accessible-megamenu",

            /* css class used to define the megamenu styling */
            menuClass: "nav-menu",

            /* css class for a top-level navigation item in the megamenu */
            topNavItemClass: "nav-item",

            /* css class for a megamenu panel */
            panelClass: "sub-nav",

            /* css class for a group of items within a megamenu panel */
            panelGroupClass: "sub-nav-group",

            /* css class for the hover state */
            hoverClass: "hover",

            /* css class for the focus state */
            focusClass: "focus",

            /* css class for the open state */
            openClass: "open"
        };

        $.extend(menuOptions, customMenuOptions);

        $(menuSelector).accessibleMegaMenu(menuOptions);
    };

    ThanksRoy.mobileMenu = function() {
        $('#primary-nav li ul').each(function() {
            var childMenu = $(this);
            var subnavToggle = $('<button type="button" class="sub-nav-toggle" aria-label="Show subnavigation"></button>');
            subnavToggle.click(function() {
                $(this).parent('.parent').toggleClass('open');
            });
            childMenu.parent().addClass('parent');
            childMenu.addClass('sub-nav').before(subnavToggle);
        });

        if ($('.sub-nav .active').length > 0) {
            var parentToggle = $('.sub-nav .active').parents('.parent').find('.sub-nav-toggle');
            parentToggle.click();
        }

        $('.menu-button').click( function(e) {
            e.preventDefault();
            $('#primary-nav ul.navigation').toggleClass('open');
        });
    };
})(jQuery);
