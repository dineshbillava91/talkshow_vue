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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.babel('resources/assets/css/style.min.css','public/css/style.min.css').version();

mix.babel('resources/assets/css/select2.min.css','public/css/select2.min.css').version();

mix.babel('resources/assets/css/util.css','public/css/util.css').version();

mix.babel('resources/assets/css/main.css','public/css/main.css').version();

mix.babel('resources/assets/css/fullcalendar.min.css','public/css/fullcalendar.min.css').version();

mix.babel('resources/assets/css/icons/font-awesome/css/fontawesome-all.css','public/css/fontawesome-all.css').version();

mix.babel('resources/assets/css/icons/themify-icons/themify-icons.css','public/css/themify-icons.css').version();

mix.babel('resources/assets/css/icons/material-design-iconic-font/css/materialdesignicons.min.css','public/css/materialdesignicons.min.css').version();

mix.babel('resources/assets/css/icons/weather-icons/css/weather-icons.min.css','public/css/weather-icons.min.css').version();

mix.babel('resources/assets/js/jquery-3.2.1.min.js','public/js/jquery-3.2.1.min.js').version();

mix.babel('resources/assets/js/jquery.min.js','public/js/jquery.min.js').version();

mix.babel('resources/assets/js/bootstrap.min.js','public/js/bootstrap.min.js').version();

mix.babel('resources/assets/js/select2.min.js','public/js/select2.min.js').version();

mix.babel('resources/assets/js/tilt.jquery.min.js','public/js/tilt.jquery.min.js').version();

mix.babel('resources/assets/js/pages/dashboards/dashboard1.js','public/js/dashboard1.js').version();

mix.babel('resources/assets/js/app-style-switcher.js','public/js/app-style-switcher.js').version();

mix.babel('resources/assets/js/waves.js','public/js/waves.js').version();

mix.babel('resources/assets/js/sidebarmenu.js','public/js/sidebarmenu.js').version();

mix.babel('resources/assets/js/custom.js','public/js/custom.js').version();
