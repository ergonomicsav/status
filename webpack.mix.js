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

mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css');
// mix.styles(['resources/assets/status/vendor/file-manager/css/file-manager.css'], 'public/vendor/file-manager/css/file-manager.css');
mix.styles(['resources/assets/status/table.css'], 'public/css/table.css' );
mix.styles(['resources/assets/status/DataTables-1.10.20/css/datatables.css'], 'public/vendor/adminlte/plugins/DataTables-1.10.20/css/datatables.css' );
// mix.copy('resources/assets/report.json', 'public/report.json');
mix.js('resources/assets/status/DataTables-1.10.20/js/datatables.js', 'public/vendor/adminlte/plugins/DataTables-1.10.20/js/datatables.js');
