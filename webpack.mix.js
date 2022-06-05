const mix = require('laravel-mix');
const path = require('path');

const alias = {
    '@': path.join(__dirname, 'resources/js')
};

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

mix.ts('resources/js/app.ts', 'public/js').webpackConfig({
    resolve: {
        alias: {
            '@resources': path.resolve(__dirname, 'resources/')
        }
    }
}).vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .alias({
        '@': 'resources/js',
    });

if (mix.inProduction()) {
    mix.version();
}
