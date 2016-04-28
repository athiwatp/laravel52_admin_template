var system = require('../_System.js').getInstance();

module.exports = {
    /**
     * Define a list of columns for the grid
     *
     * @var Object
     **/
    columns: [
        {data: 'id', name:'id', orderable: false},
        {data: 'date_start', name: 'date_start'},
        //{data: 'date_end', name:'date_end', bVisible:false},
        {data: 'title', name:'title'},
        {data: 'content', name:'description', bVisible:false}
    ],

    /**
     * Define the URLs
     *
     * @var {object}
     **/
    custURL: {
        edit: '/admin/announcements/%n/edit',
        del: system.getUrl( 'announcements/%n' )
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

        {
            render: function( data, type, row ) {

                return '<i class="fa fa-calendar"></i> ' + system.getFormattedDate( data, false ) + '<br />'+
                    '<i class="fa fa-calendar"></i> ' + system.getFormattedDate( row.date_end, false ) +
                    ( row.top_date_end ?
                        '<br /><strong><i class="fa fa-exclamation-circle" title="Актуален до ' + system.getFormattedDate( row.top_date_end, false ) + '"></i> ' +
                        system.getFormattedDate( row.top_date_end, false ) + ' </strong>'
                        : ''
                    );
            },
            width: 100,
            targets: 1
        },

        {
            render: function ( data, type, row ) {
                var noTags = system.stripTags(data),
                    published = '<i class="fa fa-eye green"></i>',
                    important = '';

                if ( row.published === false ) {
                    published = '<i class="fa fa-eye-slash red"></i>';
                }

                if ( row.important === true ) {
                    important = '<i class="fa fa-flag yellow"></i> ';
                }

                return '<a href="/admin/announcements/'+ row.id + '/edit" title="' + noTags + '">' +
                    published + ' ' + important + system.ellipsis( noTags, 100 ) +
                '</a>' + ( row.image?
                    '<br><img width="100" height="50" src="' + row.image + '" ' + 'class="img-responsive img-thumbnail">':
                    '');
            },
            targets: 2
        }
    ],

    ajax: {
        url: system.getUrl( 'announcements', { upcoming: false} )
    },

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    order: [
        [ 1, 'desc' ]
    ]


};