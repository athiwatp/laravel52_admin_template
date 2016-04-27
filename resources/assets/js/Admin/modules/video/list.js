var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', name:'id', orderable: false},
        {data: 'date', name:'date'},
        {data: 'title', name:'title'},
        {data: 'created', name:'created_at', bVisible: false },
        {data: 'updated', name:'updated_at', bVisible: false },
        {data: 'content', name:'content', bVisible: false }
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/videoNews/%n/edit',
        del: system.getUrl( 'video-news/%n' )
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
        },

        {
            render: function( data ) {
                return system.getFormattedDate( data );
            },
            targets: [1,3,4]
        },

        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                published = '<i class="fa fa-eye green"></i>',
                img = '';

                if ( row.published === false ) {
                    published = '<i class="fa fa-eye-slash red"></i>';
                }

                if (system.isEmpty( row.preview ) === false ) {
                    img = '<br /><img width="100" height="50" src="http://img.youtube.com/vi/' + row.preview + '/hqdefault.jpg" ' +
                        'class="img-responsive img-thumbnail">';
                }

                return '<a href="/admin/videoNews/'+ row.id + '/edit" title="' + noTags + '">' +
                    published + ' ' + system.ellipsis( noTags, 100 ) +
                    '</a>' + img;
            },
            targets: 2
        }
    ],

    ajax: {
        url: system.getUrl( 'video-news' )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        [ 1, 'desc' ]
    ]

};