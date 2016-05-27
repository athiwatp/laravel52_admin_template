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
        {data: 'url', name:'url'},
        {data: 'active', name:'is_active'}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/usefulLinks/%n/edit',
        del: system.getUrl( 'usefulLinks/%n' )
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
            targets:0
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/usefulLinks/'+ row.id + '/edit" title="' + noTags + '">' +
                    system.ellipsis( noTags, 100 ) +
                    '</a>' + ( row.image?
                    '<br><img width="100" height="50" src="' + row.image + '" ' + 'class="img-responsive img-thumbnail">':
                    '');
            },
            targets: 1
        },

        {
            render: function( data ) {
                return system.getPublishedIcon(data);
            },
            targets: 3
        }
    ],

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    ajax: {
        url: system.getUrl( 'usefulLinks' )
    },

    // order: [
    //     [ 6, 'desc' ]
    // ]


};