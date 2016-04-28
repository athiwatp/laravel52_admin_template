(function( factory ) {
    "use strict";

    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( ['jquery'], {}, function ( $ ) {
            return factory( $, window, document );
        } );
    } else if ( typeof exports === 'object' ) {
        // CommonJS
        module.exports = function ( $, root) {
            if ( ! root ) {
                // CommonJS environments without a window global must pass a
                // root. This will give an error otherwise
                root = window;
            }

            if ( ! $ ) {
                $ = typeof window !== 'undefined' ? // jQuery's factory checks for a global window
                    require('jquery') :
                    require('jquery')( root );
            }

            return factory( $, root, root.document );
        };
    } else {
        // Browser
        factory( jQuery, window, document );
    }

}(function( $, w ) {
    'use strict';

    var system = require('./_System.js').getInstance();
    if (typeof jQuery === 'undefined') {
        throw new Error('AdminPS area requires jQuery');
    }

    // CKEDITOR implementation
    if ( typeof w.CKEDITOR === 'undefined' ) {
        return false;
    }

    if ( $('.ck-edtor').length > 0 ) {
        w.CKEDITOR.basePath = w.CKEDITOR_BASEPATH;
        w.CKEDITOR.plugins.basePath = CKEDITOR.basePath + 'plugins/';

        w.CKEDITOR.replaceAll('ck-edtor', {
            customConfig: '/js/vendor/ckeditor/config.js'
        });
    }

}));