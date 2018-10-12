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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

//templates/blue_theme

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/font-awesome/css/font-awesome.css',
    'node_modules/hover.css/css/hover-min.css',
    'node_modules/animate.css/animate.min.css',
    'node_modules/aos/dist/aos.css'
], 'public/templates/blue_theme/assets/css/styles.css');

mix.sass('resources/assets/blue_theme/sass/style.scss', 'public/templates/blue_theme/assets/css/style.css')
    .sass('resources/assets/blue_theme/sass/color.scss', 'public/templates/blue_theme/assets/css/color.css');

mix.combine([
    'public/templates/blue_theme/assets/css/styles.css',
    'public/templates/blue_theme/assets/css/style.css',
    'public/templates/blue_theme/assets/css/color.css',
], 'public/templates/blue_theme/assets/css/styles.min.css')

mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/aos/dist/aos.js',
    'resources/assets/blue_theme/js/*.js'
], 'public/templates/blue_theme/assets/js/scripts.min.js');

mix.scripts([
    'node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
], 'public/templates/blue_theme/assets/js/plugins.min.js');

mix.copy('node_modules/font-awesome/fonts/**/*', 'public/templates/blue_theme/assets/fonts/');