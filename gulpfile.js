const gulp = require('gulp');
const gulpCopy = require('gulp-copy');
const rename = require('gulp-rename');
const zip = require('gulp-zip');
const path   = require("path");
const fs     = require("fs");
global.config = require("./gulp-config.json");

gulp.task('release', function(cb){
    gulp.src('./components/redshop/**')
        .pipe(zip('redshop-v3.0.zip'))
        .pipe(gulp.dest(config.releaseDir));
    cb();
});