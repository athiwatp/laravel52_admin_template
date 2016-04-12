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
        elId = parameters && parameters.elId ? parameters.elId : '#header-search';

    Vue.use(require('vue-resource'));

    Vue.component('my-search', {
        template: '<div>' +
            '<div class="input-group quick-search">'+
            '<input type="text" class="form-control input-lg" placeholder="Пошук по сайту">'+
            '<span class="input-group-btn">'+
            '<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-search"></i></button>'+
            '</span>'+
            '</div>'+
            '</div>'
    });

    return new Vue({
        el: elId
    });

}));