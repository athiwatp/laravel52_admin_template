var $      = require('jquery');
var loader = require( './modules/_loader.js' );

require( './types/String.js' );
require( './modules/_metis.js' );
require( './modules/_resizer.js' );

require( './modules/_ckeditor.js' );
require( './modules/_mask.js' );


//require('./modules/_datatables.js');
require( 'bootstrap-datepicker' );

$(function() {

    /**
     * Handle the grids
     **/
    $('.datatables').each(function() {
        var sModule = $(this).attr('data-module');

        if ( sModule ) {
            var module = loader.getListModule(sModule);

            if ( module ) {
                var table = require('./modules/_datatable.js')($, { object: this, settings: module, ident: sModule} );
            }
        }
    });
    // -- end of grid handling

    /**
     * Convert to URL
     *
     **/
    $('.convert-to-url').each(function() {

        $(this).on('keyup', function() {
            var sTitle = $(this).val(),
                resField = $('.data-url');

            if (resField) {
                $(resField).val( sTitle.translit() );
            }
        });

    });

    /**
     * Form handler
     **/
    $('.admin-vue-form').each(function() {
        var handler = $(this).attr('data-handler');

        if ( handler ) {
            var module = loader.getFormModule(handler);

            console.log( handler, module );
        }

    });

    /**
     * Date picker
     **/
    $('.date-controls').each(function() {
        if ( $.fn.datepicker ) {

            $(this).datepicker({
                //format: 'YYYY-MM-DD'
                format: 'yyyy-mm-dd',
                //format: {
                //    /*
                //     * Say our UI should display a week ahead,
                //     * but textbox should store the actual date.
                //     * This is useful if we need UI to select local dates,
                //     * but store in UTC
                //     */
                //    toDisplay: function (date, format, language) {
                //        var d = new Date(date);
                //        d.setDate(d.getDate() - 7);
                //
                //        return d.toISOString();
                //    },
                //
                //    toValue: function (date, format, language) {
                //        var d = new Date(date);
                //        d.setDate(d.getDate() + 7);
                //        return new Date(d);
                //    }
                //},
                autoclose: true
            });
        }
    });



});

