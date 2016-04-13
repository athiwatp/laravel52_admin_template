/**
 * Module to handle the admin forms
 *
 * @url https://vuejs.org
 **/
var Vue = require('vue');
var system = require('../_System.js').getInstance();

Vue.use(require('vue-resource'));


module.exports = new Vue({
    el: '#admin_announce_form',

    /**
     * Binded data
     **/
    data: {
        announce: {
            /**
             * Current identifier
             *
             * @var Integer
             **/
            id: 0,

            /**
             * Is topical announce
             *
             * @var Boolean
             **/
            is_topical: false,
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
         * Check if is_topical field is disabled
         *
         * @return Boolean
         **/
        isTopDateDisabled: function() {
            return ! this.announce.is_topical;
        }
    }
});