/**
 * Admin singleton
 */
var AdminSingleton = (function($) {
    'use strict';

    /**
     * Singleton instance container
     * @type {null|Singleton}
     */
    var instance = null;

    /**
     * Create singleton object
     * @constructor
     */
    function Singleton() {
        var config = {

            /**
             * API url
             *
             * @var String
             **/
            api: '/api/v1',

            /**
             * Token
             *
             * @var String
             **/
            token: $('meta[name="api_token"]').attr('content')

        };

        return {
            /**
             * Get configuration option
             **/
            _get: function(prop) {
                if (config && config.hasOwnProperty(prop)) {
                    return config[ prop ];
                }

                return '';
            },

            /**
             * Returns API url
             **/
            getUrl: function(url) {
                return this._get('api') + '/' + url + '/?api_token=' + this._get('token');
            }
        };
    }

    return {
        /***
         * Return instance of that object
         */
        getInstance: function() {
            if (null === instance) {
                instance = new Singleton;
            }

            return instance;
        }
    };
})(jQuery);

module.exports = AdminSingleton;