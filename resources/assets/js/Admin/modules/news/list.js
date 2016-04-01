var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id'},
        {data: 'date'},
        {data: 'title'}
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
            targets: 1
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    published = '<i class="fa fa-eye green"></i>',
                    main = '', important = '';

                if ( row.published === false ) {
                    published = '<i class="fa fa-eye-slash red"></i>';
                }

                if ( row.main === true ) {
                    main = '<i class="fa fa-bolt light-yellow"></i> ';
                }

                if ( row.important === true ) {
                    important = '<i class="fa fa-flag yellow"></i> ';
                }

                return '<a href="/admin/news/'+ row.id + '/edit" title="' + noTags + '">' +
                    published + ' ' + main + important + system.ellipsis( noTags, 100 ) +
                '</a>' + ( row.photo?
                    '<br><img width="100" height="50" src="' + row.photo + '" ' + 'class="img-responsive img-thumbnail">':
                    '');
            },
            targets: 2
        }
    ],

    ajax: {
        url: system.getUrl( 'news' )
    },


};