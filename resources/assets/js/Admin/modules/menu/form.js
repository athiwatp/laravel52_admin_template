/**
 * Module to handle the admin forms
 *
 * @url https://vuejs.org
 **/
var Vue = require('Vue');

module.exports = new Vue({
    el: '#admin_menu_form',

    data: {
        menu: {
            title: null
        }
    },

    /**
     * Init form
     **/
    init: function(){

    },

    /**
     * Defined methods
     **/
    methods: {
        /**
         *
         **/
        onTypeChange: function() {
            
        }
    },


    /**
     * Computed properties
     **/
    computed: {

        /**
         * Check if data ready to be sent
         **/
        isParentDisabled: function () {

            //for (var key in this.message) {
            //    if (!this.message[key]) {
            //        return true;
            //    }
            //}

            return true;
        }
    }

});