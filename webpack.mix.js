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
//    .sass('resources/assets/sass/app.scss', 'public/css')
//    .js('resources/assets/js/password-confirmation.js','public/js/password-confirmation.js')
//    .js('resources/assets/js/room.js','public/js/room.js');

// mix.js('resources/vue_components/components.js', 'public/js/component_app.js')
// mix.js('node_modules/chart.heatmap.js/dst/Chart.HeatMap.S.min.js', 'public/vendor/chart-heatmap/js/chart.heatmap.S.min.js');

// mix.js('resources/assets/js/apex.js', 'public/vendor/apexcharts/js/apexcharts.js')//apexcharts
//    .js('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', 'public/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')//bootstrap-datepicker
//    .js('resources/assets/js/jquery.js', 'public/vendor/jquery/js/jquery.js')//jquery
//    .js('resources/assets/js/datatables.js', 'public/vendor/datatables.net/js/datatables.net.js')//datatables.net
//    .js('node_modules/chart.js/dist/Chart.js', 'public/vendor/chart.js/js/chart.js');

// mix.less('node_modules/bootstrap-datepicker/build/build.less', 'public/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css')//bootstrap-datepicker
//    .styles('node_modules/datatables.net-bs/css/dataTables.bootstrap.css', 'public/vendor/datatables.net/css/datatables.net.css');

// mix.js('node_modules/mdbootstrap/js/mdb.js', 'public/vendor/mdbootstrap/js/mdb.js')
// mix.styles('node_modules/mdbootstrap/css/mdb.css', 'public/vendor/mdbootstrap/css/mdb.css')
// mix.js('node_modules/popper.js/dist/popper.js','public/vendor/popper.js/js/popper.js')
// mix.less('node_modules/font-awesome/less/font-awesome.less', 'public/vendor/font-awesome/font-awesome.css')
// mix.js('resources/assets/js/twtr-bootstrap.js', 'public/vendor/bootstrap/js/bootstrap.js')
// mix.sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/vendor/bootstrap/css/bootstrap.css')
// mix.sass('node_modules/material-icons/css/material-icons.scss', 'public/vendor/material-icons/css/mi.css');

mix.js('resources/assets/vue_components/timer.js', 'public/vue/timer.js');