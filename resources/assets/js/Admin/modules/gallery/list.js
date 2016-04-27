var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', name:'id', orderable: false},
        {data: 'title', name:'title'},
        {data: 'filename', name:'filename'},
        {data: 'description', name:'description', bVisible: false},
        {data: 'updated', name:'updated_at', bVisible: false},

    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/gallery/%n/edit',
        del: system.getUrl( 'gallery/%n' )
    },

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [{
            className: 'select-checkbox',
            render: function() {
                return '';
            },
            targets:   0
        }, {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/gallery/'+ row.id + '/edit" title="' + noTags + '">' +
                    system.ellipsis( noTags, 100 ) +
                    '</a>';
            },
            targets: 1
        }, {
            render: function( data ) {
                var img = 'пусто';

                if ( data ) {
                    img = '<img width="100" height="50" src="' + data + '" ' + 'class="img-responsive img-thumbnail">';
                }

                return img;
            },
            targets: 2
        }
    ],

    ajax: {
        url: system.getUrl( 'gallery' )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        [ 4, 'desc' ]
    ]
};