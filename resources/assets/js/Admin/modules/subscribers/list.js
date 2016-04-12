var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id'},
        {data: 'email'},
    ],

    /**
     * Renderer for the columns by the index
     *
     * @var Object
     **/
    columnDefs: [
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

    ajax: {
        url: system.getUrl( 'subscribers' )
    },


};