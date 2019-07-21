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
    mix
    .webpackConfig({
        resolve: {
            alias: {
                '@pages':  path.resolve(__dirname,'resources/js/vue/pages'),
                '@components':  path.resolve(__dirname,'resources/js/vue/components'),
                '@service':  path.resolve(__dirname,'resources/js/vue/services')
            }
        }
    })
    .js('resources/js/build.js', 'public/js')
    .sass('resources/sass/build.scss', 'public/css')
    
    .version();
