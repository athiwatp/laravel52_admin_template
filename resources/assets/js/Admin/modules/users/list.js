var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'email'},
        {data: 'phone'},
        {data: 'created'},
        {data: 'updated'}
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
            targets: [4,5]
        }, {
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


};