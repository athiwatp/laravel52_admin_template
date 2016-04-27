var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', name:'id', orderable: false},
        {data: 'email', name:'email'},
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/subscribers/%n/edit',
        del: system.getUrl( 'subscribers/%n' )
    },

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
        {
            className: 'select-checkbox',
            render: function() {
                return '';
            },
            targets:   0
        },
        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    active = '<i class="fa fa-eye green"></i>';

                if ( row.active === false ) {
                    active = '<i class="fa fa-eye-slash red"></i>';
                }

                return '<a href="/admin/subscribers/'+ row.id + '/edit" title="' + noTags + '">' +
                    active + ' ' + system.ellipsis( noTags, 100 ) +
                '</a>';
            },
            targets: 1
        }
    ],

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    ajax: {
        url: system.getUrl( 'subscribers' )
    },


};