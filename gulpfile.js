const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const notify = require('gulp-notify');

const cache = require('gulp-cache');
const clean = require('gulp-clean');
const webp = require('gulp-webp');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
};

// CSS
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('./public/build/css'))
        .pipe(notify({ 
            title: 'Gulp notification',
            message: 'CSS compilado', 
            onLast: true,
            appID: 'bienesraices-app' // 👈 AppID válido
        }));
}

// JS
function javascript() {
    return src(paths.js)
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.js'))
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('./public/build/js'))
        .pipe(notify({ 
            title: 'Gulp notification',
            message: 'JS minificado', 
            onLast: true,
            appID: 'bienesraices-app'
        }));
}

// Imágenes
function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('./public/build/img'))
        .pipe(notify({ 
            title: 'Gulp notification',
            message: 'Imagen optimizada', 
            onLast: true,
            appID: 'bienesraices-app'
        }));
}
// Version WebP
function versionWebp() {
    return src(paths.imagenes)
        .pipe(webp())
        .pipe(dest('./public/build/img'))
        .pipe(notify({ 
            title: 'Gulp notification',
            message: 'Imagen convertida a WebP', 
            onLast: true,
            appID: 'bienesraices-app'
        }));
}

// Limpieza
function limpiar() {
    return src('./public/build', { allowEmpty: true, read: false })
        .pipe(clean());
}

// Watch
function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imagenes, imagenes);
    watch(paths.imagenes, versionWebp);
}

exports.css = css;
exports.javascript = javascript;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.limpiar = limpiar;
exports.watchArchivos = watchArchivos;
exports.default = series(limpiar, parallel(css, javascript, imagenes, versionWebp, watchArchivos));
