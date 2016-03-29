//var system = require('./_System.js').getInstance();
if (typeof jQuery === 'undefined') {
    throw new Error('AdminPS area requires jQuery');
}

/**
 * CKEDITOR implementation
 **/
(function(w, $) {
    'use strict';

    if ( typeof CKEDITOR === 'undefined' ) {
        return false;
    }

    // Set base Path for the editor
    w.CKEDITOR_BASEPATH = '/js/vendor/ckeditor/';

    if ( $('.ck-edtor').length > 0 ) {
        CKEDITOR.basePath = w.CKEDITOR_BASEPATH;

        CKEDITOR.replaceAll('ck-edtor', {
            customConfig: '/js/vendor/ckeditor/config.js'
        });
    }

    console.log('The direct implementation of that code here with ', CKEDITOR);

})(window, jQuery);


//// config.extraPlugins = 'imageuploader';
//config.extraPlugins = 'lightbox,clipboard,pastefromword,tabletools,quicktable,button,toolbar,floating-tools,youtube,justify,colorbutton,colordialog,lineutils,widget,image2,imageuploader';
//// config.filebrowserImageUploadUrl = CKEDITOR.basePath + 'plugins/imgupload.php';
//config.extraAllowedContent = 'audio[*]{*},a[data-lightbox,data-title,data-lightbox-saved]';
//
//
//config.filebrowserBrowseUrl = '/admin/files/browse';
//config.filebrowserUploadUrl = '/admin/files/upload';
//config.filebrowserWindowWidth = '640';
//config.filebrowserWindowHeight = '480';


// The toolbar groups arrangement, optimized for two toolbar rows.
//config.toolbarGroups = [
//
//     {
//        name: 'document',
//        groups: ['mode', 'document', 'doctools']
//    }, {
//        name: 'others'
//    },
//    '/', {
//        name: 'basicstyles',
//        groups: ['basicstyles', 'cleanup', 'justify']
//    }, {
//        name: 'paragraph',
//        groups: ['list', 'indent', 'blocks', 'align', 'bidi']
//    }, {
//        name: 'styles'
//    }, {
//        name: 'colors'
//    }, {
//        name: 'about'
//    }
//
//];

// Remove some buttons provided by the standard plugins, which are
// not needed in the Standard(s) toolbar.
//config.removeButtons = 'Underline,Subscript,Superscript,elementspath';
//
//// Remove Plugins
//config.removePlugins = 'elementspath';
//
//// Set the most common block elements.
//config.format_tags = 'p;h1;h2;h3;pre';
//
//// Simplify the dialog windows.
//config.removeDialogTabs = 'image:advanced;link:advanced';