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
        {data: 'active'},
    ],

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/chapter/'+ row.id + '/edit" title="' + noTags + '">' +
                     system.ellipsis( noTags, 100 ) +
                    '</a>' + ( row.icon?
                    '<br><img width="100" height="50" src="' + row.icon + '" ' + 'class="img-responsive img-thumbnail">':
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

    ajax: {
        url: system.getUrl( 'chapters', {
            type: '0'
        } )
    },


};