let mix = require('laravel-mix');
let fs = require('fs-extra');

fs.removeSync('temp');

mix.options({
    postCss: [
        require('postcss-custom-properties'),
        require('postcss-nesting'),
        require('autoprefixer'),
    ]
})

mix.postCss('src/css/section--global.css', 'temp')
    .postCss('src/css/section--text-video.css', 'temp')
    .postCss('src/css/section--text-with-image.css', 'temp')
    .postCss('src/css/section--horizontal-card.css', 'temp');

mix.styles([
    'temp/section--global.css',
    'temp/section--text-video.css',
    'temp/section--text-with-image.css',
    'temp/section--horizontal-card.css',
], 'dist/sections.css');

fs.removeSync('temp');

/* let fs = require('fs-extra');
let glob = require('glob');
let mix = require('laravel-mix');

mix.options({
    postCss: [
        require('postcss-custom-properties'),
        require('postcss-nesting'),
        require('autoprefixer'),
    ]
})

// Récupère tous les fichiers CSS du répertoire src/css
let files = glob.sync('src/css/*.css');

// Applique PostCSS à chaque fichier
files.forEach(file => {
    mix.postCss(file, 'temp');
});

let tempFiles = glob.sync('temp/*.css');
// Compile all intermediate CSS files into a single file
mix.styles(tempFiles, 'dist/sections.css');

fs.removeSync('temp'); */