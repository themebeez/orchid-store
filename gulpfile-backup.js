'use strict';
// include all necessary plugins in gulp file
var gulp        = require('gulp');
var sass        = require('gulp-sass');
var sourcemaps  = require('gulp-sourcemaps');
var postcss     = require('gulp-postcss');
var autoprefixer  = require('autoprefix');
var cssnano     = require('cssnano');
var concat      = require('gulp-concat');
var uglify      = require('gulp-uglify');
var rename      = require('gulp-rename');
var rtlcss      = require('gulp-rtlcss');

// Task defined for java scripts bundling and minifying
gulp.task('scripts', function() {
    return gulp.src([
            'assets/src/js/vendor/*.js',
            'assets/src/js/libraries/*.js',
            'assets/src/js/custom/*.js',
        ])
        .pipe(concat('bundle.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest('assets/dist/js/'));
});

// task to compile scss to css
gulp.task('sass', function() {   
    return gulp.src(['assets/src/scss/master-import.scss'])
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(sass()) // compile SCSS to CSS
        .pipe(postcss([ autoprefixer(), cssnano() ])) // PostCSS plugins
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(concat('main-style.css'))
        .pipe(gulp.dest('assets/dist/css/')); // Output CSS file
});

// task to convert LTR css to RTL
gulp.task('dortl', function() {
    return gulp.src(['assets/dist/css/main-style.css'])
        .pipe(rtlcss()) // Convert to RTL.
        .pipe(rename({ suffix: '-rtl' })) // Append "-rtl" to the filename.
        .pipe(gulp.dest('assets/dist/css/')); // Output RTL stylesheets.
});

// declaring final task and command tasker
// just hit the command "gulp" it will run the following tasks...
gulp.task('default', gulp.series('scripts', 'sass', 'dortl', (done) => {

    gulp.watch('assets/src/js/**/**.js', gulp.series('scripts'));
    gulp.watch('assets/src/scss/master-import.scss', gulp.series('sass'));
    gulp.watch('assets/dist/css/main-style.css', gulp.series('dortl'));

    done();
}));