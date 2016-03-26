var $ = require('jquery');

require('./modules/_metis.js');
require('./modules/_resizer.js');

require('./modules/_datatables.js');

$(function() {
    // Handle the grids
    $('.datatables').each(function() {
        var module = $(this).attr('data-module');
    });



});

var test = require('./modules/_test_datatable.js')( window );

console.log( test.hello );
