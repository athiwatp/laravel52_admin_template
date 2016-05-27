/**
 * Module to handle the admin forms
 *
 * @url https://vuejs.org
 **/
var Vue = require('vue');
var system = require('../_System.js').getInstance();

Vue.use(require('vue-resource'));


module.exports = new Vue({
    el: '#admin_news_form',

    data: {
        news: {
            /**
             * Is necessarily photo news
             *
             * @var Boolean
             **/
            necessarily: false,
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
         * Check if necessarily field is disabled
         *
         * @return Boolean
         **/
        isNecessarilyDisabled: function() {
            return this.news.necessarily;
        }
    }
});