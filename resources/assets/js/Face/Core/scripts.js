var $       = require('jquery');
var _system = require('./../../Admin/modules/_System').getInstance();

$(function() {

    /**
     * Check if subscribe form is available by the ID
     **/
    if ( $('#footer-subscriber').length > 0 ) {
        var subcriber = require('./components/my-subscriber.js')($, {
            elId: '#footer-subscriber'
        }, _system);
    }

});