const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */



if (mix.inProduction()) {
    mix.js('resources/js/app.js', 'public/js')
        .sass('resources/sass/app.scss', 'public/css').sourceMaps().version().minify('public/js/app.js');
} else {
    mix.js('resources/js/app.js', 'public/js')
        .sass('resources/sass/app.scss', 'public/css').sourceMaps();
    //.webpackConfig(require('./webpack.config'));
}
