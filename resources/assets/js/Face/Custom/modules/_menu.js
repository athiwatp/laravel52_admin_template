/**
 * Module to handle the menu on the front end
 *
 *
 **/
module.exports = {

    /**
     * The entry point for the module
     *
     **/
    init: function() {
        var pathname = window.location.pathname;
        var url      = window.location.href,
            menu_token = jQuery('meta[name="menu_token"]').attr('content'),
            main_menu_token = jQuery('meta[name="main_menu_token"]').attr('content'),
            selector = 'a[href' +
                ( pathname === '/' ? '' : '*' ) + '="' +
                ( pathname === '/' ? url : pathname ) +
                '"],' +
                'a[href*="' + menu_token.trim() + '"],' +
                'a[href*="' + main_menu_token.trim() + '"]';

        jQuery( selector ).each(function() {
            jQuery(this).addClass('active');
        });
    }
}