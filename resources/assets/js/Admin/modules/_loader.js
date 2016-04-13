module.exports = {
    /**
     * Returns required module instance
     *
     * @param String module path
     *
     * @return Object
     **/
    getListModule: function(path) {
        var mod = null;
        switch(path) {
            case 'news/list':
                mod = require('./news/list.js');
                break;

            case 'chapters/list':
                mod = require('./chapters/list.js');
                break;

            case 'gallery/list':
                mod = require('./gallery/list.js');
                break;

            case 'pages/list':
                mod = require('./pages/list.js');
                break;

            case 'announcements/list':
                mod = require('./announcements/list.js');
                break;

            case 'customerReviews/list':
                mod = require('./customerReviews/list.js');
                break;

            case 'menu/list':
                mod = require('./menu/list.js');
                break;

            case 'users/list':
                mod = require('./users/list.js');
                break;

            case 'subscribers/list':
                mod = require('./subscribers/list.js');
                break;

            case 'video/list':
                mod = require('./video/list.js');
                break;
        }

        return mod;
    },


    /**
     * Returns Form module
     *
     * @param String module path
     *
     * @return Object
     **/
    getFormModule: function(path) {
        var mod = null;

        switch(path) {
            case 'menu/form':
                mod = require('./menu/form.js');
                break;

            case 'announcements/form':
                mod = require('./announcements/form.js');
                break;
        }

        return mod;
    }
}