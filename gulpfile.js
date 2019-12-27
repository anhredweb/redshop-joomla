const gulp      = require('gulp');
const gulpCopy  = require('gulp-copy');
const rename    = require('gulp-rename');
const zip       = require('gulp-zip');
const path      = require("path");
const fs        = require("fs");
global.config   = require("./gulp-config.json");

gulp.task('release', function(cb){
    gulp.src('./components/redshop/**')
        .pipe(zip('redshop-v3.0.zip'))
        .pipe(gulp.dest(config.releaseDir));
    cb();
});


/**
 * Gulp copy language final
 */
gulp.task('copy:language:site', function(cb){
    gulp.src(['./components/redshop/site/language/**'])
        .pipe(gulp.dest(config.wwwDir + '/language'));
    cb();
});
gulp.task('copy:language:admin', function(cb){
    gulp.src(['./components/redshop/admin/language/**'])
        .pipe(gulp.dest(config.wwwDir + '/administrator/language'));
    cb();
});
gulp.task('copy:language', gulp.series('copy:language:admin', 'copy:language:site'));

/**
 * GULP COPY COMPONENT
 */
gulp.task('copy:component:site', function(cb){
    console.log(config.wwwDir + '/components/com_redshop');
    gulp.src(
        [
            './components/redshop/site/**',
            '!./components/redshop/language/**'
        ]
    )
        .pipe(gulp.dest(config.wwwDir + '/components/com_redshop'));
    cb();
});
gulp.task('copy:component:admin', function(cb){
    console.log(config.wwwDir + '/administrator/components/com_redshop');
    gulp.src(
        [
            './components/redshop/admin/**',
            '!./components/redshop/admin/language/**'
        ]
    )
        .pipe(gulp.dest(config.wwwDir + '/administrator/components/com_redshop'));
    cb();
});
gulp.task('copy:component', gulp.series('copy:component:admin', 'copy:component:site'));

/**
 * GULP COPY LIBRARIES
 */
gulp.task('copy:library:redshop', function(cb){
    gulp.src(['./libraries/redshop/**'])
        .pipe(gulp.dest(config.wwwDir + '/libraries/redshop'));
    cb();
});

gulp.task('copy:libraries', gulp.series('copy:library:redshop'));

/**
 *  Gulp copy final
 */
gulp.task('copy',gulp.series(
    'copy:libraries',
    'copy:component',
    'copy:language'
));

