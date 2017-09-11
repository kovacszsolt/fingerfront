var public = '../../public/site/itcrowd/';
var public_images = public + 'images/';


var gulp = require('gulp'),
    rename = require('gulp-rename'),
    cssnano = require('gulp-cssnano'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    babel = require('gulp-babel'),
    babili = require("gulp-babili");


//Images
var images_files =
    ['images/favicon.png',
        'images/logo.png',
        'images/default.jpg',
        'images/logo-sm-dark.png',
        'images/svg-loaders/puff.svg',
        'images/svg-loaders/ring.svg'];

gulp.task('images_task', function () {
    gulp.src(images_files, {base: 'images/'})
        .pipe(gulp.dest(public_images));
});

//CSS
var css_files =
    [
        'css/theme-base.css',
        'css/theme-elements.css',
        'css/responsive.css',
        'css/color-variations/brown-light.css',
        'css/custom.css'
    ];
gulp.task('css_task', function () {
    gulp.src(css_files)
        .pipe(cssnano({discardComments: {removeAll: true}}))
        .pipe(concat('style.min.css'))
        .pipe(gulp.dest(public + 'css/'));
});

//JS
var js_files = [
    'js/bootstrap-notify.min.js',
    'node_modules/fingerjqueryvalidation/js/fingerDomain.js',
    'node_modules/fingerjqueryvalidation/js/JQuery.fingerValidator.js',
    'js/theme-functions.js',
    'js/custom.js'
];

gulp.task('js_task', function () {
    gulp.src(js_files)
        .pipe(concat('custom.min.js'))
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(babili({
            mangle: {
                keepClassName: true
            }
        }))
        .pipe(gulp.dest(public + 'js/'));
});

// run all task
gulp.task('all_task', function () {
    gulp.start('css_task','images_task','js_task');
});