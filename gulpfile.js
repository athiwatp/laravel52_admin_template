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
    mix.browserify('app.js');

    mix.sass('app.scss', 'public/css', { includePaths: [
        sassPaths.bootstrap,
        sassPaths.font_awesome
    ]}).copy('resources/assets/images/**', 'public/images')
        .copy(bowerDir + 'font-awesome/fonts', 'public/fonts')
        .copy(bowerDir + 'bootstrap-sass/assets/fonts', 'public/fonts');
});

