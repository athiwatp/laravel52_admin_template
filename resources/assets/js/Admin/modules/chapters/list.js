var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id',name:'id', orderable: false},
        {data: 'title',name:'title'},
        {data: 'active', name:'is_active'},
        {data: 'content', name:'description', bVisible: false},
        {data: 'updated', name:'updated_at', bVisible: false}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/chapter/%n/edit',
        del: system.getUrl( 'chapters/%n' )
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
        }, {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/chapter/'+ row.id + '/edit" title="' + noTags + '">' +
                     system.ellipsis( noTags, 100 ) +
                    '</a>' + ( row.icon ?
                    '<br><img width="100" height="50" src="' + row.icon + '" ' + 'class="img-responsive img-thumbnail">':
                    '');
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
        url: system.getUrl( 'chapters', {
            type: '%TYPE%'
        } )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        [ 4, 'desc' ]
    ]


};