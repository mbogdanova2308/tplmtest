require('es6-promise').polyfill();
var gulp          = require('gulp');
var sass          = require('gulp-sass');
var autoprefixer  = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');
var browserSync = require('browser-sync').create();
var reload = browserSync.reload;

gulp.task('images', function() {
  return gulp.src('./images/src/*')
    .pipe(imagemin({ optimizationLevel: 7, progressive: true }))
    .pipe(gulp.dest('./images/dist'));
});

gulp.task('sass', function() {
  return gulp.src('./sass/**/*.scss')
  .pipe(sass())
  .pipe(autoprefixer())
  .pipe(gulp.dest('./'))
});

gulp.task('watch', function() {
  browserSync.init({
    files: ['./**/*.php', './sass/**/*.scss'],
    proxy: 'http://localhost/wordpress/',
  });
  gulp.watch('./sass/**/*.scss', gulp.series('sass'));
    gulp.watch('./images/src/*', gulp.series('images'));
});

gulp.task('default', gulp.series('sass', 'images', 'watch'));