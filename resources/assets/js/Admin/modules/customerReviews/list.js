var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', name: 'id'},
        {data: 'date', name: 'date'},
        {data: 'client', name: 'client'},
        {data: 'published', name: 'is_published'}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/customerReviews/%n/edit',
        del: system.getUrl( 'customerReviews/%n' )
    },

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
        {
            className: 'select-checkbox',
            render: function( data ) {
                return '';
            },
            targets: 0
        },
        {
            render: function( data ) {
                return '<i class="fa fa-calendar"></i> ' + system.getFormattedDate( data );
            },
            targets: 1
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    published = '<i class="fa fa-eye green"></i>';

                if ( row.published === false ) {
                    published = '<i class="fa fa-eye-slash red"></i>';
                }

                return '<a href="/admin/customerReviews/'+ row.id + '/edit" client="' + noTags + '">' +
                    system.ellipsis( noTags, 100 ) +
                '</a>';
            },
            targets: 2
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
        url: system.getUrl( 'customerReviews' )
    },


};