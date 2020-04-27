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

mix.ts('resources/assets/js/app.ts', 'public/js')
    .js('resources/assets/js/site.js','public/js')
    .js('resources/assets/js/sw.js','public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

   //.copy('resources/assets/js/notify.min.js', 'public/js/notify.min.js');
