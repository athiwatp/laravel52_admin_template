/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function(config) {
    'use strict';

    config.language = 'ru';
    config.skin = 'moono';

    config.extraPlugins = 'lightbox,clipboard,pastefromword,tabletools,quicktable,button,toolbar,floating-tools,colorbutton,colordialog,lineutils,widget,image2';
    config.extraAllowedContent = 'audio[*]{*},a[data-lightbox,data-title,data-lightbox-saved]';

    config.contentsCss = '/js/vendor/ckeditor/contents.css';
    config.filebrowserBrowseUrl = '/admin/files';
    config.filebrowserUploadUrl = '/admin/files/upload';
    config.filebrowserWindowWidth = '640';
    config.filebrowserWindowHeight = '480';

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [

        { name: 'basicstyles', groups: ['basicstyles', 'cleanup', 'justify'] },
        { name: 'links'},
        { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools'},
        { name: 'document', groups: ['mode', 'document', 'doctools']},
        { name: 'others' },
        '/',
        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
        { name: 'styles' },
        { name: 'colors' },
        '/',
        { name: 'clipboard', groups: ['clipboard', 'undo'] }
        //{ name: 'about'}

    ];

    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = 'Underline,Subscript,Superscript,elementspath';

    // Remove Plugins
    config.removePlugins = 'elementspath';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
};