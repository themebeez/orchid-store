// Initialize modules
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const { src, dest, watch, series, parallel } = require('gulp');
// Importing all the Gulp-related packages we want to use
const sourcemaps        = require('gulp-sourcemaps');
const sass              = require('gulp-sass');
const concat            = require('gulp-concat');
const uglify            = require('gulp-uglify');
const postcss           = require('gulp-postcss');
const autoprefixer      = require('autoprefixer');
const cssnano           = require('cssnano');
const replace           = require('gulp-replace');
const notify            = require('gulp-notify');
const plumber           = require('gulp-plumber');
const rtlcss            = require('gulp-rtlcss');
const rename            = require('gulp-rename');


// File paths
const files = { 
    scssPath: 'assets/src/scss/**/*.scss',
}

// Sass task: compiles the style.scss file into style.css
function SassTask(){
        var onError = function(err) {
            notify.onError({
                title:    "Gulp",
                subtitle: "Failure!",
                message:  "Error: <%= error.message %>",
                sound:    "Beep"
            })(err);
        this.emit('end');
    };    
    return src(files.scssPath)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(plumber({errorHandler: onError}))
        .pipe(sass()) // compile SCSS to CSS
        .pipe(postcss([ autoprefixer(), cssnano() ])) // PostCSS plugins
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(concat('main-style.css'))
        .pipe(dest('assets/dist/css/')
    ); // put final CSS in dist folder
}

// Watch task: watch SCSS and JS files for changes
// If any change, run scss and js tasks simultaneously
function WatchTask(){
    watch([files.scssPath],
        {interval: 1000, usePolling: true}, //Makes docker work
        series(
            parallel(SassTask),
        )
    );    
}

// Export the default Gulp task so it can be run
// Runs the scss and js tasks simultaneously
// then runs cacheBust, then watch task
exports.default = series(
    parallel(SassTask), 
    WatchTask
);