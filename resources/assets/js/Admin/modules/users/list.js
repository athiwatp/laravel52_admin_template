var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', id:'id'},
        {data: 'name', name:'email'},
        {data: 'email', name:'email'},
        {data: 'phone', name:'phone'},
        //{data: 'created', name:'created_at', bVisible: false},
        //{data: 'updated', name:'updated_at', bVisible: false}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/users/%n/edit',
        del: system.getUrl( 'users/%n' )
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
        //    render: function( data ) {
        //        return system.getFormattedDate( data );
        //    },
        //    targets: [4,5]
        //},

        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    active = system.getPublishedIcon( row.is_verified),
                    admin = row.is_admin === true ? '<i class="fa fa-user-secret black"></i> ' : '';

                return '<a href="/admin/users/'+ row.id + '/edit" title="' + noTags + '">' +
                    active + ' ' + admin + system.ellipsis( noTags, 100 ) +
                    '</a>';
            },
            targets: 1
        }

        //{
        //    render: function( data ) {
        //        return system.getPublishedIcon(data);
        //    },
        //    targets: 3
        //}
    ],

    ajax: {
        url: system.getUrl( 'users' )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        //[ 5, 'desc' ]
    ]

};