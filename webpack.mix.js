const mix = require("laravel-mix");
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

mix
  .webpackConfig({ stats: { children: false } })
  // .js("src/backend/js/backend.js", "backend/js")
  .postCss("src/backend/css/backend.css", "backend/css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ])
  .postCss("src/backend/css/metabox.css", "backend/css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ])
  .postCss("src/frontend/css/frontend.css", "frontend/css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ])
  .js("src/frontend/js/frontend.js", "frontend/js")
  .react()
  // .sourceMaps(false, "source-map")
  .disableSuccessNotifications();
