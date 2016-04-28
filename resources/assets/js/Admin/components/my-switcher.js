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
        elId = parameters && parameters.elId ? parameters.elId : '#switcher';

    Vue.component('my-switcher', {
        template: '<div class="btn-group btn-toggle" @click="onSwitcherClick($event, this)" v-el:wrapper>' + 
                '<button class="btn btn-default">{{ cmpNo }}</button>' +
                '<input type="hidden" name="{{ cmpName }}" value="{{ cmpValue }}"  v-model="status">'+
                '<button class="btn btn-success active">{{ cmpYes }}</button>' +
        '</div>',
        /**
         * Describe the properties for the component
         *
         * @var Object
         **/
        props: {
            cmpYes: {
                type: String,
                default: 'Yes'
            },
            cmpNo: {
                type: String,
                default: 'No'
            },
            cmpValue: {
                type: String,
                default: '1'
            },
            cmpName: {
                type: String,
                default: 'switcher'
            }
        },

        ready: function() {
            var val = this.$get('cmpValue');
            this.status = val;

            if ( val === '0' ) {
                // console.log(this.$els.wrapper);
                this._toggle(this.$els.wrapper);
            }
        },

        /**
         * Data
         *
         * @var Object
         **/
        data: function() {
            return {
                status:''
            }
        },

        /**
         * The list of available methods
         *
         * @var Object
         **/
        methods: {
            onSwitcherClick:function(event, obj){
                // var target = event.target;
                var element = obj.$el;
                event.preventDefault();

                if (this.status === '1') {
                    this.status = '0';
                } else {
                    this.status = '1';
                }

                this._toggle(element);
            },

            _toggle: function(element) {
                $(element).find('.btn').toggleClass('active');

                if ($(element).find('.btn-primary').size() > 0) {
                    $(element).find('.btn').toggleClass('btn-primary');
                }
                if ($(element).find('.btn-danger').size() > 0) {
                    $(element).find('.btn').toggleClass('btn-danger');
                }
                if ($(element).find('.btn-success').size() > 0) {
                    $(element).find('.btn').toggleClass('btn-success');
                }
                if ($(element).find('.btn-info').size() > 0) {
                    $(element).find('.btn').toggleClass('btn-info');
                }

                $(element).find('.btn').toggleClass('btn-default');
            }

        },

        /**
         * Computed properties
         *
         * @var Object
         **/
        computed: {
        }
    });

    return new Vue({
        el: elId
    });

}));