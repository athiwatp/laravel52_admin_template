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
    'use strict';

    var Vue = require('vue'),
        elId = parameters && parameters.elId ? parameters.elId : '#street-switcher';

    Vue.use(require('vue-resource'));

    Vue.component('my-street-switcher', {
        template: '<div class="well well-sm">'+
            '<h4><label>{{ cmpTitle }}</label></h4>' +
            '<p><input name="query" v-model="filterKey"></p>'+
            '<ul class="region-switcher">' +
            '<li v-for="item in items | filterBy filterKey">'+
            //'   <input type="checkbox" value="{{ item.id }}" id="chk_district_{{ item.id }}" />'+
            '   <label class="region-name" v-bind:class="[item.open ? \'opened\' : \'\']" for="chk_district_{{ item.id }}" @click="toggle(item)">'+
            '       <span v-if="hasStreets(item)">[ {{ item.open === false ? treeChars.plus : treeChars.minus }} ]</span>'+
            '       <span v-if="hasStreets(item)===false">[ {{ treeChars.star }} ]</span>'+
            '       {{ item.title }}'+
            '   </label>'+
            '   <ul v-if="item.open">'+
            '       <li v-for="street in item.streets">'+
            '           <input type="checkbox" value="{{ street.id }}" id="chk_street_{{ street.id }}" v-model="selectedIds" name="{{ cmpChkName }}[]" />'+
            '           <label for="chk_street_{{ street.id }}">{{ street.title }}</label>'+
            '       </li>'+
            '   </ul>'+
            '</li>'+
            '</ul>'+
            //'<span>Selected Ids: {{ selectedIds | json }}</span>'+
            '</div>',

        /**
         * Describe the properties for the component
         *
         * @var Object
         **/
        props: {
            /**
             * Regio title
             *
             * @var Object
             **/
            cmpTitle: {
                type: String,
                default: 'Regions'
            },

            /**
             * The component name for checkbox
             *
             * @var Oject
             **/
            cmpChkName: {
                type: String,
                default: 'streets'
            },

            /**
             * The list of checked items
             *
             * @var Array
             **/
            cmpChecked: {
                type: String,
                default: ''
            }
        },

        /**
         * Data container
         *
         * @var Object
         **/
        data: function() {
            return {
                /**
                 * The list of regions with streets
                 *
                 * @var Array
                 **/
                items: null,

                /**
                 *
                 **/
                filterKey: '',

                /**
                 *
                 **/
                open: false,

                /**
                 * Tree char
                 *
                 * @var Object
                 **/
                treeChars: {
                    plus: '+',
                    minus: '-',
                    star:'*'
                },

                selectedIds: []
            }
        },

        /**
         * When component is ready to be rendered
         **/
        ready: function() {
            var self = this;

            self._sendRequest().then(function() {});
        },

        /**
         * The list of available methods
         *
         * @var Object
         **/
        methods: {

            /**
             * Send ajax request to server
             *
             * @param Object data
             **/
            _sendRequest: function(data) {
                var self = this,
                    selected = self.cmpChecked.split(','),
                    sUrl = _system.getUrl( 'districts', {aggregated: true, checked: self.cmpChecked} );

                return Vue.http.get(sUrl)
                    .then(function(response) {
                        if ( response.ok === true ) {
                            self.items = response.data;

                            if ( _system.isArray(selected) ) {
                                self.selectedIds = selected;
                            }

                            self.items.forEach(function(district){

                                if ( _system.isArray(district.streets) ) {
                                    var arr = district.streets;

                                    for (var i = 0; i < arr.length; i++) {
                                        if ( selected.contains(arr[i]['id']) ) {
                                            district.open = true;
                                            return false;
                                        }
                                    }
                                }
                            });
                        }

                    }, function( response ) {})
                    .finally(function(response){

                        }
                    );
            },

            /**
             *
             **/
            toggle: function (item) {
                if (this.isFolder) {
                    item.open = !item.open;
                }
            },

            /**
             *
             **/
            hasStreets: function(item) {
                return item && item.streets && item.streets.length > 0;
            }
        },

        computed: {
            /**
             * Check if node has child component
             *
             **/
            isFolder: function() {
                return true;
            }
        }
    });

    return new Vue({
        el: elId
    });
}));