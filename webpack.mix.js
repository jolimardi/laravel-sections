let mix = require('laravel-mix');

mix.postCss('src/css/section--text-video.css', 'temp')
    .postCss('src/css/section--text-with-image.css', 'temp')
    .postCss('src/css/section--horizontal-card.css', 'temp');

mix.styles([
    'temp/section--text-video.css',
    'temp/section--text-with-image.css',
    'temp/section--horizontal-card.css',
], 'dist/sections.css');

mix.options({
    postCss: [
        require('postcss-custom-properties'),
        require('postcss-nesting'),
        require('autoprefixer'),
    ]
})