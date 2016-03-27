var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id'},
        {data: 'preview'},
        {data: 'title'},
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
            targets: [3,4]
        }, {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data);

                return '<a href="/admin/videoNews/'+ row.id + '/edit" title="' + noTags + '">' +
                     system.ellipsis( noTags, 100 ) +
                    '</a>';
            },
            targets: 2
        }, {
            render: function( data ) {
                var img = '';

                if (system.isEmpty( data ) === false ) {
                    img = '<img width="100" height="50" src="http://img.youtube.com/vi/' + data + '/hqdefault.jpg" ' +
                        'class="img-responsive img-thumbnail">';
                }

                return img;
            },
            targets: 1
        }
    ],

    ajax: {
        url: system.getUrl( 'video-news' )
    },


};