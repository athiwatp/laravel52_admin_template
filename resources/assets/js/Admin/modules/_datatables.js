'use strict';

var $          = require( 'jquery' );
$.fn.dataTable = require( 'datatables.net' )( window, $ );

require( 'datatables.net-buttons' )( window, $ );
var autofill = require( 'datatables.net-autofill' )( window, $ );

var _system = require('./_System.js');
//
require( 'datatables.net-buttons/js/buttons.colVis.js' )(); // Column visibility
require( 'datatables.net-buttons/js/buttons.html5.js' )();  // HTML 5 file export
require( 'datatables.net-buttons/js/buttons.flash.js' )();  // Flash file export
require( 'datatables.net-buttons/js/buttons.print.js' )();  // Print view button

//$.fn.DataTable.Buttons = buttons;
//$.fn.dataTable.AutoFill = autofill;

$(function() {
    var system = _system.getInstance();

    $('.datatables').each(function() {
        var sUrl = $(this).attr('data-url'),
            sColumn = $(this).attr('data-columns'),
            sEditUrl = $(this).attr('data-edit-url');

        if (sUrl) {
            var table = $(this).dataTable( {
                //dom: 'Blfrtip',

                stateSave: true,

                responsive: true,

                processing: true,
                serverSide: true,

                ajax: {
                    url: system.getUrl( sUrl )
                },

                columns: JSON.parse(sColumn),


                columnDefs: [{
                    render: function ( data, type, row ) {

                        return '<a href="' + sEditUrl.replace('%id%', row.id) + '">' + data + '</a>';
                    },
                    targets: 1
                }]

            } );

            $(this).on( 'click', 'tr', function () {
                $('.edit-btn, .delete-btn').attr('disabled', true);

                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');

                    $('.edit-btn, .delete-btn').removeAttr('disabled');
                }
            } );

            //new $.fn.dataTable.Buttons( table, {
            //    buttons: [
            //        'copy', 'excel', 'pdf'
            //    ]
            //} );
        }

    });
});

