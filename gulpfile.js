var elixir = require('laravel-elixir');

// Define the boer path
var bowerDir = './resources/assets/vendor/';

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
        .copy(bowerDir + 'font-awesome/fonts', 'public/fonts')
        .copy(bowerDir + 'bootstrap-sass/assets/fonts', 'public/fonts')
        .copy(bowerDir + 'metisMenu/dist/metisMenu.min.css', 'public/css/vendor/metisMenu.min.css');

    // Copy JavaScript libraries
    mix.copy(bowerDir + 'jquery/dist/jquery.min.js', 'public/js/vendor/jquery.min.js')
        .copy(bowerDir + 'bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/js/vendor/bootstrap.min.js')
        .copy(bowerDir + 'metisMenu/dist/metisMenu.min.js', 'public/js/vendor/metisMenu.min.js');
});

