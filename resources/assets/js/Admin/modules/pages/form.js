/**
 * Module to handle the admin forms
 *
 * @url https://vuejs.org
 **/
var Vue = require('vue');
var system = require('../_System.js').getInstance();

Vue.use(require('vue-resource'));


module.exports = new Vue({
    el: '#admin_pages_form',

    /**
     * Binded data
     **/
    data: {
        pages: {
            /**
             * Current identifier
             *
             * @var Integer
             **/
            id: 0,

            /**
             * Is url pages
             *
             * @var String
             **/
            url: '',

            /**
             * Is public_url pages
             *
             * @var String
             **/
            public_url: '',

            /**
             * Is template_url pages
             *
             * @var String
             **/
            template_url: ''
        }
    },

    /**
     * Init form
     **/
    ready: function() {
        var self = this;
    },

    /**
     *
     **/
    computed: {
        /**
         * Check if page field is url
         *
         * @return String
         **/
        convertToPublicUrl: function() {
            var url = this.pages.url, public_url = '', template_url = this.pages.template_url;

            public_url = template_url.replace('%%url%%', url);

            return public_url;
        }
    }
});