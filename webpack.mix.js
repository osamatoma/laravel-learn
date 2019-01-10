let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 // run time server
 // mix.browserSync();

// js
mix.js('resources/js/app.js', 'public/js').version();

// mix all into one js file after compile
mix.scripts([
    'public/js/mainfest.js',
    'public/js/vendor.js',
    'public/js/app.js',
    'public/js/main.js',
], 'public/js/all.js');

// sass
mix.sass('resources/sass/app.scss', 'public/css')
.sass('resources/sass/osama.sass', 'public/css').options({
		processCssUrls: false
}).version() ;

// mix all into one css file after compile
mix.styles([
    'public/css/osama.css',
    'public/css/main.css',
    'public/css/app.css'
], 'public/css/all.css');

// disable OS Notifications

mix.disableNotifications();
