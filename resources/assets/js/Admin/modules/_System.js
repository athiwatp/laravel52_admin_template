/**
 * Admin singleton
 */
var AdminSingleton = (function($) {
    'use strict';

    var moment = require('moment');

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
            getUrl: function(url, params) {
                var ext = '';

                if ( this.isObject(params) ) {
                    var tmp = [];

                    for( var index in params) {
                        tmp.push(index + '=' + params[index]); 
                    }

                    if (tmp.length > 0) {
                        ext = tmp.join('&');
                    } 
                }

                return this._get('api') + '/' + url + '/?api_token=' + this._get('token') + ( ext ? '&' + ext : '');
            },

            /**
             * Returns true if the passed value is empty, false otherwise. The value is deemed to be empty if it is either:
             *
             * - `null`
             * - `undefined`
             * - a zero-length array
             * - a zero-length string (Unless the `allowEmptyString` parameter is set to `true`)
             *
             * @param {Object} value The value to test
             * @param {Boolean} allowEmptyString (optional) true to allow empty strings (defaults to false)
             * @return {Boolean}
             *
             **/
            isEmpty: function(value, allowEmptyString) {
                return (value === null) ||
                    (value === undefined) || (!allowEmptyString ? value === '' : false) ||
                    (this.isArray(value) && value.length === 0);
            },

            /**
             * Returns true if the passed value is a JavaScript Array, false otherwise.
             *
             * @param {Object} target The target to test
             * @return {Boolean}
             * @method
             */
            isArray: ('isArray' in Array) ? Array.isArray : function(value) {
                return toString.call(value) === '[object Array]';
            },

            /**
             *
             **/
            stripTags: function( str ) {
                if (this.isEmpty(str)) {
                    return '';
                }

                return str.replace(/(<([^>]+)>)/ig, '');
            },

            /**
             * Truncate a string and add an ellipsis ('...') to the end if it exceeds the specified length.
             *
             * @param {String} value The string to truncate.
             * @param {Number} length The maximum length to allow before truncating.
             * @param {Boolean} [word=false] `true` to try to find a common word break.
             * @return {String} The converted text.
             */
            ellipsis: function(value, len, word) {
                if (value && value.length > len) {
                    if (word) {
                        var vs = value.substr(0, len - 2),
                            index = Math.max(vs.lastIndexOf(' '), vs.lastIndexOf('.'), vs.lastIndexOf('!'), vs.lastIndexOf('?'));
                        if (index !== -1 && index >= (len - 15)) {
                            return vs.substr(0, index) + "...";
                        }
                    }
                    return value.substr(0, len - 3) + "...";
                }
                return value;
            },

            /**
             * Published icon
             *
             **/
            getPublishedIcon: function( status ) {
                return status === true ? '<i class="fa fa-check green"></i>' : '<i class="fa fa-ban red"></i>';
            },

            /**
             * Returns true if the passed value is a string.
             * @param {Object} value The value to test
             * @return {Boolean}
             */
            isString: function(value) {
                return typeof value === 'string';
            },

            /**
             * Returns true if the passed value is a JavaScript Object, false otherwise.
             *
             * @param {Object} value The value to test
             * @return {Boolean}
             * @method
             */
            isObject: (toString.call(null) === '[object Object]') ?
                function(value) {
                    // check ownerDocument here as well to exclude DOM nodes
                    return value !== null && value !== undefined && toString.call(value) === '[object Object]' && value.ownerDocument === undefined;
                } :
                function(value) {
                    return toString.call(value) === '[object Object]';
                },

            /**
             * Get formatted data
             *
             **/
            getFormattedDate: function( data ) {

                if ( this.isEmpty(data) ) {
                    return '';
                }

                if ( this.isObject(data) && data.hasOwnProperty('date') ) {
                    data = data.date;
                }

                var date = moment(data);

                return this.isObject(date) ?
                    date.format('DD.MM.Y HH:mm') : '';
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