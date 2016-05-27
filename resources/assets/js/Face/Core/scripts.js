var $       = require('jquery');
var _system = require('./../../Admin/modules/_System').getInstance();

require('lightbox2');

$(function() {

    /**
     * Check if subscribe form is available by the ID
     **/
    if ( $('#header-search').length > 0 ) {
        var search = require('./components/my-search.js')($, {
            elId: '#header-search'
        }, _system);
    }

    /**
     * Check if subscribe form is available by the ID
     **/
    if ( $('#footer-subscriber').length > 0 ) {
        var subcriber = require('./components/my-subscriber.js')($, {
            elId: '#footer-subscriber'
        }, _system);
    }

    /**
     * Check if event calendar is available
     **/
    if ( $('#event-calendar').length > 0 ) {
        var calendar = require('./components/my-event-calendar.js')($, {
            elId: '#event-calendar'
        }, _system);
    }

    /**
     * Check if news calendar is available
     **/
    if ( $('#news-calendar').length > 0 ) {
        var calendar = require('./components/my-news-calendar.js')($, {
            elId: '#news-calendar'
        }, _system);
    }

    /**
     * Show the image gallery component
     *
     **/
    if ( $('.photo-gallery').length > 0 ) {
        $('.photo-gallery').each(function() {
            var id = $(this).attr('id');

            if ( _system.isEmpty(id) ) {
                id = _system.generateId();

                $(this).attr('id', id);
            }

            var gallery = require('./components/my-gallery.js')($, {
                elId: '#' + id
            }, _system);
        });
    }

    /**
     * Handle the photo item
     *
     **/
    var photoItemSelector = '.photo-gallery-item';
    if ( $(photoItemSelector).length > 0 ) {


        $(photoItemSelector).each(function () {

            $(this).on('click', function (event) {
                event = event || window.event;

                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event, titleProperty: 'title'},
                    links = $('a.link-item');

                // Inlcude Blueimp library
                require('blueimp-gallery');

                // Cancel all commands
                event.preventDefault();

                blueimp.Gallery(links, options);

                return false;
            });

        });

        $(photoItemSelector).append(
            '<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">'+
            '<div class="slides"></div>'+
            '<h3 class="title"></h3>'+
            '<a class="prev">‹</a>'+
            '<a class="next">›</a>'+
            '<a class="close">×</a>'+
            '<a class="play-pause"></a>'+
            '<ol class="indicator"></ol>'+
            '</div>'
        );
    }


});