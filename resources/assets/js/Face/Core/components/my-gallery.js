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
        elId = parameters && parameters.elId ? parameters.elId : '#galley-component';

    Vue.use(require('vue-resource'));

    Vue.component('my-photo-gallery', {
        /**
         * Define template for Gallery
         *
         * @var String
         **/
        template: '<div>'+
            '<h1>{{ cmpTitle }} <a href="{{ cmpGalleryAllUrl }}" class="more-link">{{ cmpGalleryPageTitle }}</a></h1>'+
            '<div v-for="item in items" class="col-sm-4 item" @click="onLinkClick($event)">'+
            '<a class="thumbnail link-item" href="{{ item.big_image }}" title="{{ item.title }}">'+
            '<i class="fa fa-search-plus"></i>'+
            '<img v-bind="{ src:item.image }" alt="{{ item.title }}" >'+
            '</a>'+
            '</div>'+

            '<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">'+
            '<div class="slides"></div>'+
            '<h3 class="title"></h3>'+
            '<a class="prev">‹</a>'+
            '<a class="next">›</a>'+
            '<a class="close">×</a>'+
            '<a class="play-pause"></a>'+
            '<ol class="indicator"></ol>'+
            '</div>'+
            '</div>',

        /**
         * Describe the properties for the component
         *
         * @var Object
         **/
        props: {
            /**
             * Gallery title
             *
             * @var Object
             **/
            cmpTitle: {
                type: String,
                default: 'Gallery'
            },

            /**
             * All title
             *
             * @var Object
             **/
            cmpGalleryPageTitle: {
                type: String,
                default: 'All photo'
            },

            /**
             * LInk to all photos
             *
             * @var Object
             **/
            cmpGalleryAllUrl: {
                type: String,
                default: '/'
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
                 * The list of photos
                 *
                 * @var Array
                 **/
                items: null
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
             * Handle the gallery lightbox
             *
             **/
            onLinkClick: function(event) {
                event = event || window.event;

                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event, titleProperty:'title'},
                    links = $('a.link-item');

                // Inlcude Blueimp library
                require('blueimp-gallery');

                // Cancel all commands
                event.preventDefault();

                blueimp.Gallery(links, options);

                return false;
            },

            /**
             * Send ajax request to add data to database
             *
             * @param Object data
             **/
            _sendRequest: function(data) {
                var self = this,
                    sUrl = _system.getUrl( 'gallery', {latest: true} );

                return Vue.http.get(sUrl)
                    .then(function(response) {
                        if ( response.ok === true ) {
                            self.items = response.data;
                        }

                    }, function( response ) {
                        console.log('Fail!!!!');
                    })
                    .finally(function(response){

                        }
                    );
            }
        }
    });

    return new Vue({
        el: elId
    });

}));