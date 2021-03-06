const mix = require('laravel-mix');

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

mix.sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/global.js', 'public/js');
mix.js('resources/js/scripts.js', 'public/js');
mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/css/pages', 'public/css/pages');
mix.copyDirectory('resources/js/pages', 'public/js/pages');

mix.sass('resources/sass/pages/error/error.scss', 'public/css/pages/error');

mix.sass('resources/sass/login.scss', 'public/css');
mix.copy('resources/js/login.js', 'public/js');
