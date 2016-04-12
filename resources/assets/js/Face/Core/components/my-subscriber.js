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
        elId = parameters && parameters.elId ? parameters.elId : '#footer-subscriber';

    Vue.use(require('vue-resource'));

    Vue.component('my-subscriber', {
        template: '<div>' +
            '<h3>{{ cmpHeader }}</h3>'+
            '<p class="info-text">{{ cmpDescription }}</p>'+
            '<div class="input-group subscribe-form">'+
            '<input type="text" class="form-control input-lg" @keyup="onEmailFieldKeyUp($event)" :disabled="isTextDisabled" v-model="field.email" placeholder="{{ cmpFieldPlaceholder }}">'+
            '<span class="input-group-btn">'+
            '<button class="btn btn-primary btn-lg" @click="onSubscribeBtnClick()" :disabled="isButtonDisabled" type="button">'+
            '<i class="fa fa-envelope"></i>'+
            '</button>'+
            '</span>'+
            '</div>'+
            '<div class="{{ notifier.cls }}" v-show="status.done">'+
            //'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
            '<strong>{{ notifier.status }}</strong> {{ notifier.message }}'+
            '</div>'+
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
                },
                /**
                 * Status object to determine the process
                 *
                 * @var Boolean
                 **/
                status: {
                    saving: false,

                    done: false,

                    SUCCESS: 'alert alert-success',
                    FAILURE: 'alert alert-danger',
                    WARNING: 'alert alert-warning',
                },

                notifier: {
                    status: '',

                    message: '',

                    cls: ''
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
                var email = this.field.email;

                this._sendRequest({email: email});
            },

            /**
             * Handling the key up event for the email field
             *
             * @param event
             **/
            onEmailFieldKeyUp: function(event) {
                var email = this.field.email;

                // Cancel all commands
                event.preventDefault();

                if ( event.keyCode == 13 && this._checkEmail( email ) === true ) {
                    this._sendRequest({email: email});
                }
            },

            /**
             * Check if email was entered correctly
             *
             * @param String email
             *
             * @return Boolean (true | false)
             **/
            _checkEmail: function(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                return re.test( email );
            },

            /**
             * Send ajax request to add data to database
             *
             * @param Object data
             *
             **/
            _sendRequest: function(data) {
                var self = this,
                    sUrl = _system.getUrl( 'subscriber' );

                self.status.saving = true;
                self.status.done = false;

                return Vue.http.post(sUrl, data, {})
                    .then(function(response) {
                            if ( response ) {
                                var r = response.data;

                                if ( r.success === true ) {
                                    self.notifier.cls = self.status.SUCCESS;
                                    self.notifier.message = r.message;
                                    self.notifier.status = 'Ok!';

                                    self.field.email = '';
                                } else {
                                    self.notifier.cls = self.status.FAILURE;
                                    self.notifier.message = r.errors[0];
                                    self.notifier.status = 'Ошибка!';
                                }

                                self.status.done = true;
                            }
                        }, function(response) {
                            console.log('Fail!!!!');
                        }
                    )
                    .finally(function(response){
                        self.status.saving = false;

                        setTimeout(function() {
                            self.status.done = false;
                        }, 15000);
                    });
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
                return this.status.saving === true || ! this._checkEmail( this.field.email );
            },

            /**
             * Check if text field can be available
             *
             **/
            isTextDisabled: function() {
                return this.status.saving;
            }
        }
    });

    return new Vue({
        el: elId
    })



}));