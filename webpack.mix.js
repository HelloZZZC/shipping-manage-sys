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

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/main.scss', 'public/css');

/**
 * 将node_modules中的前端模版相关依赖的js打包成main.js
 */
mix.babel(
    [
        'node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/jquery/dist/jquery.min.js',
        'node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
        'node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/chart.js/dist/Chart.min.js',
        'node_modules/@creative-tim-official/argon-dashboard-free/assets/js/argon.js',
    ],
    'public/js/main.js'
).minify('public/js/main.js').version();

mix.autoload({
    jquery: ['$', 'window.jQuery']
});

/**
 * 整合首页依赖的css
 */
mix.copy('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/nucleo/css/nucleo.css', 'public/vendor/nucleo/css/main.css');
mix.copy('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css', 'public/vendor/fontawesome-free/css/main.css');

/**
 * 整合需要的字体
 */
mix.copyDirectory('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/nucleo/fonts', 'public/vendor/nucleo/fonts');
mix.copyDirectory('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/@fortawesome/fontawesome-free/webfonts', 'public/vendor/fontawesome-free/webfonts');
