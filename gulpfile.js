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
 * GULP COPY
 */
gulp.task('copy:component:site', function(cb){
    gulp.src(['./components/redshop/site/**'])
        .pipe(gulp.dest(config.wwwDir + '/components/com_redshop'));
    cb();
});
gulp.task('copy:component:admin', function(cb){
    gulp.src(['./components/redshop/admin/**'])
        .pipe(gulp.dest(config.wwwDir + '/administrator/components/com_redshop'));
    cb();
});
gulp.task('copy:component', gulp.series('copy:component:admin', 'copy:component:site'));
gulp.task('copy',gulp.series('copy:component'));

