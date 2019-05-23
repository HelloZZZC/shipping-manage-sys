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

/**
 * 整合首页依赖的css
 */
mix.sass('resources/sass/main.scss', 'public/css');
mix.copy('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/nucleo/css/nucleo.css', 'public/vendor/nucleo/css/main.css');
mix.copy('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css', 'public/vendor/fontawesome-free/css/main.css');


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

/**
 * 将一些组件js拷贝到libs目录下方便引用
 */
mix.copy('node_modules/jquery-validation/dist/jquery.validate.min.js', 'public/js/libs/jquery-validation/jquery.validate.min.js');
mix.copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'public/js/libs/bootstrap-datepicker/bootstrap-datepicker.min.js');
mix.copy('node_modules/bootstrap-notify/bootstrap-notify.min.js', 'public/js/libs/bootstrap-notify/bootstrap-notify.min.js');
mix.js('resources/js/app/index', 'public/js/app');
mix.js('resources/js/login/index.js', 'public/js/login');
mix.js('resources/js/setting/system/index.js', 'public/js/setting/system');
mix.js('resources/js/import/index.js', 'public/js/import');
mix.js('resources/js/import/file/index.js', 'public/js/import/file');
mix.js('resources/js/shipping/index.js', 'public/js/shipping');
mix.js('resources/js/homepage/index.js', 'public/js/homepage');
mix.js('resources/js/user/index.js', 'public/js/user');
mix.js('resources/js/user/create/index.js', 'public/js/user/create');
mix.js('resources/js/user/import-file/index.js', 'public/js/user/import-file');
mix.js('resources/js/my/homepage/index.js', 'js/my/homepage');
mix.js('resources/js/my/change-password/index.js', 'js/my/change-password');

/**
 * 整合需要的字体
 */
mix.copyDirectory('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/nucleo/fonts', 'public/vendor/nucleo/fonts');
mix.copyDirectory('node_modules/@creative-tim-official/argon-dashboard-free/assets/vendor/@fortawesome/fontawesome-free/webfonts', 'public/vendor/fontawesome-free/webfonts');
