(function( factory ) {
    "use strict";

    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( ['jquery'], {}, function ( $, parameters ) {
            return factory( $,  parameters, window, document );
        } );
    } else if ( typeof exports === 'object' ) {
        // CommonJS
        module.exports = function (root, $, parameters) {
            if ( ! root ) {
                // CommonJS environments without a window global must pass a
                // root. This will give an error otherwise
                root = window;
            }

            if ( ! $ ) {
                $ = typeof window !== 'undefined' ? // jQuery's factory checks for a global window
                    require('jquery') :
                    require('jquery')( root );
            }

            return factory( $, parameters, root, root.document );
        };
    } else {
        // Browser
        factory( jQuery, {}, window, document );
    }

}(function( $, parameters, window, document, undefined ) {
    "use strict";

    if ( $ && $.fn && ! $.fn.dataTable ) {
        $.fn.dataTable = require('datatables.net')(window, $);

        // Include all required libraries
        require('datatables.net-buttons/js/buttons.colVis.js')(); // Column visibility
        require('datatables.net-buttons/js/buttons.html5.js')();  // HTML 5 file export
        require('datatables.net-buttons/js/buttons.flash.js')();  // Flash file export
        require('datatables.net-buttons/js/buttons.print.js')();  // Print view button
    }

    $.extend( settings.oBrowser, DataTable.__browser );

    var table = { hello:'Mother Fuck!!!' };

    console.log('Hello from here!!!!!');

    return table;
}));