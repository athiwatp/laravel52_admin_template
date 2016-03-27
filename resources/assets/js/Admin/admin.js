var $      = require('jquery');
var loader = require( './modules/_loader.js' );

require( './types/String.js' );
require( './modules/_metis.js' );
require( './modules/_resizer.js' );

//require('./modules/_datatables.js');


$(function() {
    /**
     * Handle the grids
     **/
    $('.datatables').each(function() {
        var sModule = $(this).attr('data-module');

        if ( sModule ) {
            var module = loader.getModule(sModule);

            if ( module ) {
                var table = require('./modules/_datatable.js')($, { object: this, settings: module} );
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



});

