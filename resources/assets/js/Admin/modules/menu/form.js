/**
 * Module to handle the admin forms
 *
 * @url https://vuejs.org
 **/
var Vue = require('vue');
var system = require('../_System.js').getInstance();

Vue.use(require('vue-resource'));

module.exports = new Vue({
    el: '#admin_menu_form',

    data: {
        menu: {
            /**
             * Current identifier
             *
             * @var Integer
             **/
            id: 0,

            /**
             * Menu title
             *
             * @var String
             **/
            title: null,

            /**
             * Menu type
             *
             * @var String ('M', 'F', 'S')
             **/
            type: '0',

            /**
             * Parent identifier
             *
             * @var Integer
             **/
            parent: 0,

            /**
             * Linked menu identifier
             *
             * @var Integer
             **/
            linked_to: 0,

            /**
             * Check if redirectable
             *
             * @var Bolean
             **/
            is_redirectable: false,

            /**
             * Page identifier
             *
             * @var Integer
             **/
            page_id: 0
        },

        retrieved: {
            parent_id: 0,

            linked_id: 0
        },

        /**
         * Data
         **/
        linked: [
            {text: '-- Виберіть зв\'язну сторінку --', value:'0', type: ''}
        ],

        /**
         * Parents
         **/
        parents: [],

        /**
         * Default element for parents list
         **/
        parentDefault: [
            {text: '-- Виберіть батьківський елемент --', value:'-1'},
            {text: '*** Кореневий елемент системи ***', value:'0'}
        ]

    },

    /**
     * Init form
     **/
    ready: function(){
        var self = this;

        if (self.menu.type != 0) {
            self.onTypeChange();
        }

        for(var i in self.parentDefault) {
            self.parents.push(self.parentDefault[i]);
        }

        self.menu.parent = self.retrieved.parent_id;
        self.menu.linked_to = self.retrieved.linked_id;

        if ( self.retrieved.parent_id > 0 || self.retrieved.linked_id > 0) {
            self.retrieveData();
        }
    },

    /**
     * Defined methods
     **/
    methods: {

        checkFormBeforeSaving: function(event) {
            var self = this;

            //event.preventDefault();

            return false;
        },

        /**
         * Handle the status change for the type menu DropDown
         **/
        onTypeChange: function() {
            var self = this;

            self.menu.parent = 0;

            // Retrieve Data
            self.retrieveData();
        },

        /**
         * Show module dialog
         *
         **/
        showModulesDialog: function() {

        },

        /**
         * Retrieve data from server
         *
         **/
        retrieveData: function() {
            var self = this;

            // retrieve the parent elements
            self.retrieveParents().finally(function(){
                // Get linked pages
                self.fetchLinkedItems();
            });
        },

        /**
         * Do a AJAX request to retrieve data from server
         **/
        fetchLinkedItems: function() {
            var url = system.getUrl( 'menu', {}), self = this;

            if (self.linked && self.linked.length > 1) {
                return true;
            }

            return this.$http.get(url, {}, {}).then(function(responce) {

                if ( responce && responce.status === 200 ) {
                    var data = responce.data ? responce.data.data : [];

                    for(var i in data) {
                        self.linked.push({
                            text: data[i].title,
                            value: data[i].id,
                            type: data[i].type
                        });
                    }
                }
            }, function(error) {
                alert('Error');
            }).finally(function(){
                //this.$set('submitting', false);
                return true;
            });
        },

        /**
         * Retrieve parents list
         **/
        retrieveParents: function() {
            var self = this, url = system.getUrl( 'menu', {
                type: self.menu.type
            });

            return this.$http.get(url).then(function(responce) {
                var data = responce.data ? responce.data.data : [];

                // Update the parent list
                self.parents = [];

                for(var i in self.parentDefault) {
                    self.parents.push(self.parentDefault[i]);
                }

                for(var i in data) {
                    self.parents.push({
                        text: data[i].title,
                        value: data[i].id
                    });
                }
            });
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
            return !(this.parents.length > 1);
        },

        /**
         *
         **/
        isLinkedDisabled: function() {

            if ( this.menu['type'] === 'S' || this.menu['type'] === 'F' ) {
                return false;
            }

            this.menu.linked_to=0;

            return true;
        },

        /**
         * Filtered value
         **/
        linkedList: function () {

            return this.linked.filter(function( item ){
                return !(item.type === 'S' );
            });

        },

        /**
         *
         **/
        parentList: function() {
            return this.parents;
        },


        /**
         *
         **/
        isRedirectTextDisabled: function() {
            return !this.menu.is_redirectable;
        },

        /**
         *
         **/
        isRedirectDisabledPage: function() {
            return this.menu.is_redirectable;
        }
    }

});