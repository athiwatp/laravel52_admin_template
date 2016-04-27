var $      = require('jquery');
var loader = require( './modules/_loader.js' );
var _system = require( './modules/_System.js').getInstance();

require( './types/String.js' );
require( './modules/_metis.js' );
require( './modules/_resizer.js' );
require( './modules/_ckeditor.js' );
require( './modules/_mask.js' );

//require('./modules/_datatables.js');
require( 'bootstrap-datepicker' );

$(function() {

    if ( $('.switcher').length > 0 ) {
        $('.switcher').each(function() {
            var id = $(this).attr('id');

            if ( _system.isEmpty(id) ) {
                id = _system.generateId();

                $(this).attr('id', id);
            }
            console.log(id);

            var gallery = require('./components/my-switcher.js')($, {
                elId: '#' + id
            }, _system);
        });
    }

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

    // Toolbar buttons
    // 1. edit_menu
    if ( $('#edit').length > 0 ) {

        console.log('Hey!!!!');

        $('#edit').on('click', function(e) {
            var self = this;

            e.preventDefault();

            $(self).attr('disabled', true);

            $('.datatables').each(function() {
                var tbl = $( this ).dataTable().api();

                if (_system.isEmpty(tbl) === false) {
                    var initOption = tbl.init(),
                        ids = $.map(tbl.rows('.selected').data(), function (item) {
                            return _system.isObject(item) ? item.id : 0;
                        }
                    );

                    if ( ids.length > 0 && initOption && initOption.custURL && initOption.custURL.edit) {
                        var url = initOption.custURL.edit.sprintf(ids[0]);

                        _system.redirectTo(url);
                    }

                    $(self).removeAttr('disabled');
                }
            });

            return false;
        });
    }

    // 2. delete_menu
    if ( $('#delete').length > 0 ) {
        $('#delete').on('click', function(e) {
            var self = this;

            e.preventDefault();

            if ( _system.isEmpty( $(self).attr('disabled') ) === false ) {
                return false;
            }

            $(self).attr('disabled', 'disabled');

            $('.datatables').each(function() {
                var tbl = $( this ).dataTable().api();

                if (_system.isEmpty(tbl) === false) {
                    var initOption = tbl.init(),
                        ids = $.map(tbl.rows('.selected').data(), function (item) {
                                return _system.isObject(item) ? item.id : 0;
                            }
                        );

                    if ( ids.length > 0 && initOption && initOption.custURL && initOption.custURL.del) {
                        var sUrl = initOption.custURL.del.sprintf(ids[0]);

                        if ( confirm("Удалить выбранную запись?") === true ) {
                            _system.ajax(sUrl, {
                                type: 'DELETE',
                                async: true
                            }).then(function(){
                                tbl.draw();
                            }).done(function() {
                                $(self).removeAttr('disabled');
                            });
                        } else {
                            $(self).removeAttr('disabled');
                        }
                    }

                }
            });

            return false;
        });
    }

    // 3. refresh menu
    if ( $('#refresh').length > 0 ) {
        $('#refresh').on('click', function(e) {
            e.preventDefault();

            $(this).attr('disabled', 'disabled');

            $('.datatables').each(function() {
                var tbl = $( this ).dataTable().api();

                tbl.draw();
            });

            $(this).removeAttr('disabled');

            return false;
        });
    }
    // End of Toolbar Handlers //

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
        }

    });

    /**
     * Date picker
     **/
    $('.date-controls').each(function() {
        if ( $.fn.datepicker ) {

            $(this).datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        }
    });
    // ====== //



});

