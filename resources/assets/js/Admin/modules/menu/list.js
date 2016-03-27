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
        {data: 'pos'},
        {data: 'published'},
        {data: 'created'}
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
            targets: 4
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/menu/'+ row.id + '/edit" title="' + noTags + '">' +
                    system.ellipsis( noTags, 100 ) +
                    '</a>';
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

    ajax: {
        url: system.getUrl( 'menu' )
    },


};