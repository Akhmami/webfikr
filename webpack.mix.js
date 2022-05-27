const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])
    .js("resources/js/web.js", "public/js/web.js")
    .postCss("resources/css/web.css", "public/css/web.css", [
        require("tailwindcss"),
    ])
    .js("resources/js/psb.js", "public/js/psb.js")
    .postCss("resources/css/psb.css", "public/css/psb.css", [
        require("tailwindcss"),
    ])
    .postCss("resources/css/pas.css", "public/css/pas.css", [
        require("tailwindcss"),
    ])
    .copy('node_modules/tinymce', 'public/js/tinymce')
    .copy('node_modules/intl-tel-input/build/js/utils.js', 'public/vendor/intl-tel-input/build/js')
    .copy('node_modules/intl-tel-input/build/img', 'public/vendor/intl-tel-input/build/img');

if (mix.inProduction()) {
    mix.version();
}
