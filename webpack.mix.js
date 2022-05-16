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
    .vue({ version: 2 })
    .sass('resources/scss/app.scss', 'public/css')
    .options({
        postCss: [
            require('postcss-import'),
            require('@tailwindcss/nesting')(require('postcss-nesting')),
            require('tailwindcss'),
            require('autoprefixer'),
            require('postcss-preset-env')({
                features: { 'nesting-rules': false },
            }),
        ],
    })
    .webpackConfig({
        stats: {
            children: true,
        },
    });

if (mix.inProduction()) {
    mix.version();
}
