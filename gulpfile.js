var elixir = require('laravel-elixir');

// Define the boer path
var bowerDir = './resources/assets/vendor/';
var nodeDir = './node_modules/';

// Sass Paths
var sassPaths = {
    'bootstrap': bowerDir + 'bootstrap-sass/assets/stylesheets',
    'font_awesome': bowerDir + 'font-awesome/scss'
};

// The regular elixir handler
elixir(function(mix) {
    // Custom Front-End Theme Javascript
    mix.browserify('app.js');

    // Custom Admin Theme Javascript
    mix.browserify('Admin/admin.js');

    // SaSS for the Front-End
    mix.sass('app.scss', 'public/css', { includePaths: [
        sassPaths.bootstrap,
        sassPaths.font_awesome
    ]});

    // SaSS implementation for Admin Area
    mix.sass('Admin/admin.scss', 'public/css', { includePaths: [
        sassPaths.bootstrap,
        sassPaths.font_awesome
    ]});

    // Copy Resources and CSS
    mix.copy('resources/assets/images/**', 'public/images')
        .copy(bowerDir + 'datatables/media/images', 'public/css/images')
        .copy(bowerDir + 'font-awesome/fonts', 'public/fonts')
        .copy(bowerDir + 'bootstrap-sass/assets/fonts', 'public/fonts')
        .copy(bowerDir + 'datatables/media/css/jquery.dataTables.min.css', 'public/css/vendor/jquery.dataTables.min.css')
        .copy(bowerDir + 'metisMenu/dist/metisMenu.min.css', 'public/css/vendor/metisMenu.min.css')
        .copy(nodeDir + 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css', 'public/css/vendor/datepicker.min.css');

    // Copy JavaScript libraries
    mix.copy(bowerDir + 'jquery/dist/jquery.min.js', 'public/js/vendor/jquery.min.js')
        .copy(bowerDir + 'jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js', 'public/js/vendor/inputmask.min.js')
        .copy(bowerDir + 'bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/js/vendor/bootstrap.min.js')
        .copy(bowerDir + 'metisMenu/dist/metisMenu.min.js', 'public/js/vendor/metisMenu.min.js');
});

