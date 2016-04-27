// Include the core implementation
require('./../Core/scripts.js');

require('./modules/_langSwitcher.js');

// Include jquery
var $ = require('jquery');

$(function() {
    if ($.fn.langSwitch) {
        $('.lang-switch').langSwitch();
    }

});