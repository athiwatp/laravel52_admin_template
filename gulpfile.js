var elixir = require('laravel-elixir');

// Define the boer path
var bowerDir  = './resources/assets/vendor/';
var nodeDir   = './node_modules/';
var customJs  = './resources/assets/js/';

// Sass Paths
var sassPaths = {
    bootstrap: bowerDir + 'bootstrap-sass/assets/stylesheets',
    font_awesome: bowerDir + 'font-awesome/scss',
    flag_icon_css: bowerDir + 'flag-icon-css/sass'
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
        sassPaths.font_awesome,
        sassPaths.flag_icon_css
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
        .copy(bowerDir + 'flag-icon-css/flags', 'public/flags')
        .copy(bowerDir + 'bootstrap-sass/assets/fonts', 'public/fonts')
        .copy(bowerDir + 'datatables/media/css/jquery.dataTables.min.css', 'public/css/vendor/jquery.dataTables.min.css')
        .copy(bowerDir + 'metisMenu/dist/metisMenu.min.css', 'public/css/vendor/metisMenu.min.css')
        .copy(nodeDir + 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css', 'public/css/vendor/datepicker.min.css')
        // Blueimp
        .copy(nodeDir + 'blueimp-gallery/css/blueimp-gallery.min.css', 'public/css/vendor/blueimp.min.css')
        .copy(nodeDir + 'blueimp-gallery/img/**', 'public/css/img')

        // Lightbox2
        .copy(nodeDir + 'lightbox2/dist/css/lightbox.min.css', 'public/css/vendor/lightbox.min.css')
        .copy(nodeDir + 'lightbox2/dist/images', 'public/css/images');

    // Copy JavaScript libraries
    mix.copy(bowerDir + 'jquery/dist/jquery.min.js', 'public/js/vendor/jquery.min.js')
        .copy(bowerDir + 'jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js', 'public/js/vendor/inputmask.min.js')
        .copy(bowerDir + 'bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/js/vendor/bootstrap.min.js')
        .copy(bowerDir + 'metisMenu/dist/metisMenu.min.js', 'public/js/vendor/metisMenu.min.js');

    // Copy CKEditor stuff
    mix.copy(bowerDir + 'ckeditor/ckeditor.js', 'public/js/vendor/ckeditor/ckeditor.min.js')
        .copy(bowerDir + 'ckeditor/styles.js', 'public/js/vendor/ckeditor/styles.js')
        .copy(bowerDir + 'ckeditor/lang/ru.js', 'public/js/vendor/ckeditor/lang/ru.js')
        .copy(bowerDir + 'ckeditor/skins/moono', 'public/js/vendor/ckeditor/skins/moono')
        .copy(bowerDir + 'ckeditor/contents.css', 'public/js/vendor/ckeditor/contents.css')
        .copy(customJs + 'Admin/libs/ckeditor/config.js', 'public/js/vendor/ckeditor/config.js')
        // Extra plugins
        .copy(customJs + 'Admin/libs/ckeditor/floating-tools', 'public/js/vendor/ckeditor/plugins/floating-tools')
        .copy(customJs + 'Admin/libs/ckeditor/lightbox', 'public/js/vendor/ckeditor/plugins/lightbox')
        .copy(customJs + 'Admin/libs/ckeditor/quicktable', 'public/js/vendor/ckeditor/plugins/quicktable')
        .copy(customJs + 'Admin/libs/ckeditor/imageuploader', 'public/js/vendor/ckeditor/plugins/imageuploader')

        .copy(bowerDir + 'ckeditor/plugins', 'public/js/vendor/ckeditor/plugins');
});

