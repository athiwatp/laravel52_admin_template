(function( factory ) {
    "use strict";

    // AMD
    if ( typeof define === 'function' && define.amd ) {
        define( ['jquery'], {}, function ( $, parameters ) {
            return factory( $,  parameters );
        } );
    }
    // CommonJS
    else if ( typeof exports === 'object' ) {
        module.exports = function ( $, parameters ) {

            if ( ! $ ) {
                $ = require('jquery');
            }

            return factory( $, parameters );
        };
    }
    // Browser
    else {
        factory( jQuery, {} );
    }

}(function( $, parameters ) {
    "use strict";

    var Vue = require('vue'),
        elId = parameters && parameters.elId ? parameters.elId : '#footer-subscriber';

    Vue.component('my-subscriber', {
        template: '<div>' +
            '<h3>{{ cmpHeader }}</h3>'+
            '<p class="info-text">{{ cmpDescription }}</p>'+
            '<form>'+
            '<div class="input-group subscribe-form">'+
            '<input type="text" class="form-control input-lg" v-model="field.email" placeholder="{{ cmpFieldPlaceholder }}">'+
            '<span class="input-group-btn">'+
            '<button class="btn btn-primary btn-lg" @click="onSubscribeBtnClick()" :disabled="isButtonDisabled" type="button">'+
            '<i class="fa fa-envelope"></i>'+
            '</button>'+
            '</span>'+
            '</div>'+
            '</form>'+
            '</div>',

        /**
         * Describe the properties for the component
         *
         * @var Object
         **/
        props: {
            /**
             * Header for the component
             *
             * @var String
             **/
            cmpHeader: {
                type: String,
                default: 'Subscribe on updates'
            },

            /**
             * Description for the field
             *
             * @var String
             **/
            cmpDescription: {
                type: String,
                default: 'Description for the component'
            },

            /**
             * Field placeholder
             *
             * @var String
             **/
            cmpFieldPlaceholder: {
                type: String,
                default: 'Please enter your Email'
            }
        },

        /**
         * Data
         *
         * @var Object
         **/
        data: function(){
            return {
                field: {
                    email: "test@visp.com.ua"
                }
            };
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
            onSubscribeBtnClick: function() {
                alert('Hello ... I have just clicked on subscribe button!!!!');
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
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                return ! re.test( this.field.email );
            }
        }
    });

    return new Vue({
        el: elId
    })



}));