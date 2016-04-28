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
        {data: 'content', name:'content', bVisible: false},
        {data: 'published', name:'is_published'}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/news/%n/edit',
        del: system.getUrl( 'news/%n' )
    },

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
        {
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
            targets: 1
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    main = '', important = '';

                if ( row.main === true ) {
                    main = '<i class="fa fa-bolt light-yellow"></i> ';
                }

                if ( row.important === true ) {
                    important = '<i class="fa fa-flag yellow"></i> ';
                }

                return '<a href="/admin/news/'+ row.id + '/edit" title="' + noTags + '">' +
                    main + important + system.ellipsis( noTags, 100 ) +
                '</a>' + ( row.photo?
                    '<br><img width="100" height="50" src="' + row.photo + '" ' + 'class="img-responsive img-thumbnail">':
                    '');
            },
            targets: 2
        },
        {
            render: function( data ) {
                return system.getPublishedIcon(data);
            },
            targets: 4
        }
    ],

    ajax: {
        url: system.getUrl( 'news' )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        [ 1, 'desc' ]
    ]


};