(function( factory ) {
    "use strict";

    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( ['jquery'], {}, function ( $, parameters ) {
            return factory( $,  parameters, window, document );
        } );
    } else if ( typeof exports === 'object' ) {
        // CommonJS
        module.exports = function ( $, parameters, root) {
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

    var defaults = {
        stateSave: true,
        responsive: true,
        processing: true,
        serverSide: true,



        //columns: JSON.parse(sColumn),

        //columnDefs: [{
        //    render: function ( data, type, row ) {
        //
        //        return '<a href="' + sEditUrl.replace('%id%', row.id) + '">' + data + '</a>';
        //    },
        //    targets: 1
        //}]
    };

    var object = parameters.object,
        options = parameters.settings,
        objectSettings = {};

    if ( $ && $.fn && ! $.fn.dataTable ) {
        $.fn.dataTable = require('datatables.net')(window, $);

        // Include all required libraries
        require('datatables.net-buttons/js/buttons.colVis.js')(); // Column visibility
        require('datatables.net-buttons/js/buttons.html5.js')();  // HTML 5 file export
        require('datatables.net-buttons/js/buttons.flash.js')();  // Flash file export
        require('datatables.net-buttons/js/buttons.print.js')();  // Print view button
    }

    // Merge objects
    var settings = $.extend( {}, defaults, options );

    // creating the datatable instance
    var table = $(object).dataTable(settings);

    // Handle the selection option for the table
    $(object).on( 'click', 'tr', function () {
        $('.edit-btn, .delete-btn').attr('disabled', true);

        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');

            $(this).addClass('selected');

            $('.edit-btn, .delete-btn').removeAttr('disabled');
        }
    } );

    return table;
}));