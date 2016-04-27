var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', name: 'id', orderable: false},
        {data: 'title', name: 'title'},
        {data: 'pos', name: 'pos'},
        {data: 'published', name: 'is_published'},
        {data: 'created', name: 'created_at'}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/menu/%n/edit',
        del: system.getUrl( 'menu/%n' )
    },

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [{
            className: 'select-checkbox',
            render: function( data ) {
                return '';
            },
            targets:   0
        },

        {
            render: function( data ) {
                return system.getFormattedDate( data );
            },
            targets: 4
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    sLinked = '';

                if ( system.isEmpty(row.linked) === false ) {
                    console.log(row.linked, row.title);

                    sLinked = '<br />' +
                            '<ul class="linked-menu">';

                    for ( var i = 0; i < row.linked.length; i++) {
                        sLinked += '<li><a href="/admin/menu/'+ row.linked[i].id + '/edit">' + row.linked[i].title + '</a></li>';
                    }

                    sLinked += '</ul>';
                }

                return '<a href="/admin/menu/'+ row.id + '/edit" title="' + noTags + '" class="edit-link">' +
                    system.ellipsis( noTags, 100 ) +
                    '</a>' +
                    sLinked;
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

    order: [
        [ 4, 'desc' ]
    ],

    ajax: {
        url: system.getUrl( 'menu' )
    },


};