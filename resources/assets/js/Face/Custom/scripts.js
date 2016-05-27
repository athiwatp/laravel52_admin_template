// Include the core implementation
require('./../Core/scripts.js');

require('./modules/_langSwitcher.js');
require('./modules/_pageScroller.js');

var social = require('./modules/_social.js');
var menu = require('./modules/_menu.js');

// Include jquery
var $ = require('jquery');

$(function() {
    if ($.fn.langSwitch) {
        $('.lang-switch').langSwitch();
    }

    if ( social ) {
        social.init();
    }

    if ( menu ) {
        menu.init();
    }
});