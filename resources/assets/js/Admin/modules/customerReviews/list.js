var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id'},
        {data: 'title'},
        {data: 'date'}
    ],

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
        {
            render: function( data ) {
                return system.getFormattedDate( data );
            },
            targets: 2
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    published = '<i class="fa fa-eye green"></i>';

                if ( row.published === false ) {
                    published = '<i class="fa fa-eye-slash red"></i>';
                }

                return '<a href="/admin/customerReviews/'+ row.id + '/edit" title="' + noTags + '">' +
                    published  + system.ellipsis( noTags, 100 ) +
                '</a>';
            },
            targets: 1
        }
    ],

    ajax: {
        url: system.getUrl( 'customerReviews' )
    },


};