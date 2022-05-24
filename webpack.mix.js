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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .js('resources/js/select.js', 'public/js')
    .vue()
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/auth.scss', 'public/css')
    .sass('resources/scss/admin.scss', 'public/css')
    .options({
        processCssUrls: false
    });

mix.copyDirectory([
    'vendor/tinymce/tinymce',
    'vendor/pradosoft/tinymce-langs'
], 'public/js/tinymce');

if (mix.inProduction()) {
    mix.version();
}
