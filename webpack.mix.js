const mix = require("laravel-mix");

require("laravel-mix-tailwind");

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

mix.js("resources/js/app.js", "public/js/app.js")
    .sass("resources/sass/app.scss", "public/css/app.css")
    .js("resources/js/web.js", "public/js/web.js")
    .sass("resources/sass/web.scss", "public/css/web.css")
    .js("resources/js/psb.js", "public/js/psb.js")
    .sass("resources/sass/psb.scss", "public/css/psb.css")
    .tailwind("./tailwind.config.js")
    .copy('node_modules/tinymce', 'public/js/tinymce')
    // .js('resources/js/web.js', 'public/js/web.js')
    // .postCss("resources/css/web.css", "public/css/web.css", [
    //     require("tailwindcss")
    // ])
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
