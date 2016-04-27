var system = require('../_System.js').getInstance();

module.exports = {
    stateSave: false,
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', name:'id'},
        {data: 'title', name:'title'},
        {data: 'published', name:'is_published'},
        {data: 'subtitle', name:'subtitle', bVisible: false},
        {data: 'content', name:'content', bVisible:false},
        {data: 'created', name:'created_at', bVisible:false},
        {data: 'updated', name:'updated_at', bVisible:false}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/pages/%n/edit',
        del: system.getUrl( 'pages/%n' )
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

        //{
        //    /**
        //     * Render date
        //     **/
        //    render: function( data ) {
        //        return system.getFormattedDate( data );
        //    },
        //    targets: [2,3]
        //},

        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/pages/'+ row.id + '/edit" title="' + noTags + '">' +
                    system.ellipsis( noTags, 100 ) +
                    '</a>';
            },
            targets: 1
        },

        {
            render: function( data ) {
                return system.getPublishedIcon(data);
            },
            targets: 2
        }
    ],

    ajax: {
        url: system.getUrl( 'pages' )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        [ 6, 'desc' ]
    ]


};