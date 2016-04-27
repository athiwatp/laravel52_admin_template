(function( factory ) {
    "use strict";

    // AMD
    if ( typeof define === 'function' && define.amd ) {
        define( ['jquery'], {}, function ( $, parameters, _system ) {
            return factory( $,  parameters, _system );
        } );
    }
    // CommonJS
    else if ( typeof exports === 'object' ) {
        module.exports = function ( $, parameters, _system ) {

            if ( ! $ ) {
                $ = require('jquery');
            }

            return factory( $, parameters, _system );
        };
    }
    // Browser
    else {
        factory( jQuery, {}, _system );
    }

}(function( $, parameters, _system ) {
    "use strict";

    var Vue = require('vue'),
        Awesompelete = require('awesomplete'),
        elId = parameters && parameters.elId ? parameters.elId : '#header-search';

    Vue.use(require('vue-resource'));

    Vue.component('my-search', {
        template: '<div>' +
            '<div class="input-group quick-search">'+
            '<input type="text" class="form-control input-lg" @keyup="onSearchFieldKeyUp($event)" :disabled="isTextDisabled" v-model="field.search" placeholder="{{ cmpFieldPlaceholder }}" value="{{ cmpSearchValue }}">'+
            '<span class="input-group-btn">'+
            '<button class="btn btn-primary btn-lg" type="button" @click="onSearchBtnClick()" :disabled="isButtonDisabled">'+
            '<i class="fa fa-search"></i>'+
            '</button>'+
            '</span>'+
            '</div>'+
            '</div>',
        /**
         * Describe the properties for the component
         *
         * @var Object
         **/
        props: {
            /**
             * Field placeholder
             *
             * @var String
             **/
            cmpFieldPlaceholder: {
                type: String,
                default: 'Search field'
            },


            /**
             * Value for the search field
             *
             * @var String
             **/
            cmpSearchValue: {
                type: String,
                default: ''
            }
        },

        /**
         * Data
         *
         * @var Object
         **/
        data: function() {
            return {
                field: {
                    search: ""
                },
                /**
                 * Status object to determine the process
                 *
                 * @var Boolean
                 **/
                status: {
                    /**
                     * Saving status for the process
                     *
                     * @var Boolean
                     **/
                    redirect: false
                },
            }
        },

        /**
         * The list of available methods
         *
         * @var Object
         **/
        methods: {
            /**
             * Handle the button click event
             *
             * @var function
             **/
            onSearchBtnClick: function () {
                var search = this.field.search;

                this._redirect( search );
            },

            /**
             * Handling the key up event for the email field
             *
             * @param event
             **/
            onSearchFieldKeyUp: function(event) {
                var search = this.field.search;

                // Cancel all commands
                event.preventDefault();

                if ( event.keyCode == 13 && this.field.search.length > 3 ) {
                    this._redirect( search );
                }
            },

            /**
             * Redirect to the search page
             *
             **/
            _redirect: function( txt ) {
                this.status.redirect = true;

                window.location.href = '/search?keywords=' + txt;
            }
        },

        /**
         * Computed properties
         *
         * @var Object
         **/
        computed: {
            /**
             * Check if user can click on subscribe button
             *
             **/
            isButtonDisabled: function() {
                return this.status.redirect === true || this.field.search.length < 4;
            },

            /**
             * Check if text field can be available
             *
             **/
            isTextDisabled: function() {
                return this.status.redirect;
            }
        }
    });

    return new Vue({
        el: elId
    });

}));