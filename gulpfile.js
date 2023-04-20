'use strict';
const gulp = require('gulp');
const {watch} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');

const paths = {
    styles: {
        src: 'template-parts/block/**/style.scss',
    },
};
const adminClass = '.interface-interface-skeleton__content';

function defaultTask() {
    return gulp.src(paths.styles.src)
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cleanCSS())
        .pipe(gulp.dest(file => file.base));
}

exports.default = function () {
    defaultTask();

    watch(paths.styles.src, defaultTask)
};