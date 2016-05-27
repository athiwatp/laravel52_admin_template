var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'date', name:'created_at'},
        {data: 'comment', name:'comment'},
        {data: 'related_object', name:'object_type'},
        {data: 'user', name:'user_id'}
    ],

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
        {
            render: function( data ) {
                return system.getFormattedDate( data, true );
            },
            targets: 0
        },
        {
            render: function ( data, type, row ) {
                var link = row.related_object.url ? row.related_object.url : '#';

                if ( row.related_object.url ) {
                    return '<a href="' + link + '">' + system.ellipsis( system.stripTags(data), 100 )
                    + '</a>';
                } else {
                    return system.ellipsis( system.stripTags(data), 100 );
                };
            },
            targets: 1
        },
        {
            render: function ( row ) {
                return row ? row.title : '';
            },
            targets: 2
        },
        {
            render: function ( row ) {

                return '<div title="Тел ' + row.phone + '">' + row.name + '</div>';
            },
            targets: 3
        }
    ],

    ajax: {
        url: system.getUrl( 'logs' )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        [ 1, 'desc' ]
    ]


};