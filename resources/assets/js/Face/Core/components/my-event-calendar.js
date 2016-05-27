(function( factory ) {
    "use strict";

    // AMD
    if ( typeof define === 'function' && define.amd ) {
        define( ['jquery'], {}, function ( $, parameters, _system ) {
            return factory( $,  parameters, _system );
        } );
    }
    // CommonJS
    else if ( typeof exports === 'object' ) {
        module.exports = function ( $, parameters, _system ) {

            if ( ! $ ) {
                $ = require('jquery');
            }

            return factory( $, parameters, _system );
        };
    }
    // Browser
    else {
        factory( jQuery, {}, _system );
    }

}(function( $, parameters, _system ) {
    "use strict";

    var Vue = require('vue'),
        elId = parameters && parameters.elId ? parameters.elId : '#event-calendar';

    // include component
    require('bootstrap-datepicker');

    Vue.use(require('vue-resource'));

    Vue.component('my-event-calendar', {
        template:'<div id="event-calendar-wrapper"></div>',

        /**
         * Describe the properties for the component
         *
         * @var Object
         **/
        props: {
            /**
             * Current date
             *
             * @var String
             **/
            currDate: {
                type: String,
                default: null
            },
        },

        /**
         * Data structure
         *
         **/
        date: function(){
            return {
                /**
                 * The object with dates
                 *
                 * @var Object
                 **/
                dates: {}
            };
        },

        /**
         * Execute once the component is build and ready for work
         *
         **/
        ready: function() {
            var self = this,
                wrapper = '#event-calendar-wrapper',
                currDate = self.$get('currDate' ) || new Date(),
                defaultDate = new Date( currDate );

            // Senf ajax request
            self._sendRequest().then(function() {

                // Init the calendar
                $(wrapper).datepicker({
                    language: 'uk',
                    todayHighlight: true,
                    defaultViewDate: {
                        year: defaultDate.getFullYear(),
                        month: defaultDate.getMonth(),
                        day: defaultDate.getDate()
                    },
                    beforeShowDay: function (date) {
                        var year = date.getFullYear(),
                            month = date.getMonth() + 1,
                            day = date.getDate(),
                            dtObject = self.dates;

                        if ( dtObject.hasOwnProperty( year ) ) {
                            if ( dtObject[year] && dtObject[year].hasOwnProperty( month ) ) {
                                if ( dtObject[year][month] && dtObject[year][month].hasOwnProperty( day ) ) {
                                    var announces = dtObject[year][month][day],
                                        tooltip = '';

                                    for (var i = 0; i < announces.length; i++) {
                                        tooltip += '' + (i+1) +' . ' + announces[i].title  + "\n";
                                    }

                                    //tooltip += '</ul>';

                                    return {
                                        tooltip: tooltip,
                                        classes: 'cal-check'
                                    };
                                }
                            }
                        }

                        return false;
                    }
                });

                /**
                 * Handle the date selection event
                 **/
                $(wrapper).on('changeDate', function(ev){
                    var date = ev.date;

                    if ( date ) {
                        var url = _system.getStaticURL('announce', {timestamp: date.getTime() / 1000});

                        // Redirect to URL
                        _system.redirectTo(url);
                    }
                });
            });

            // Define Ukrainian language
            $.fn.datepicker.dates['uk'] = _system.getDatepickerLangObject();
        },

        /**
         * Define the methods
         **/
        methods: {
            /**
             * Send request to server to get the list of upcoming events
             *
             **/
            _sendRequest: function() {
               var self = this,
                   sUrl = _system.getUrl( 'announcements', { upcoming: true } );

                return Vue.http.get(sUrl)
                    .then(function(response) {
                        if ( response.ok === true ) {
                            self.dates = response.data;
                        }
                    }, function( response ) {
                        // console.log('Fail!!!!');
                    })
                    .finally(function(response){

                    });
            }
        }
    });

    // Build and return component
    return new Vue({
        el: elId
    });
}));