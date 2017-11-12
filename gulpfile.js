var gulp = require('gulp');
var sass = require('gulp-sass');
var browserify = require('gulp-browserify');

gulp.task('default', ['scss', 'js', 'copy']);

gulp.task('scss', function() {
    return gulp.src([
        'resources/assets/sass/**/*.scss'
    ]).pipe(sass())
      .pipe(gulp.dest('public/css'));
});

gulp.task('js', function() {
    gulp.src('resources/assets/js/app.js')
        .pipe(browserify({transform: [[{_flags: {debug: true}}, "vueify"]]}))
        .pipe(gulp.dest('public/js'));
});

gulp.task('copy', function() {
    return gulp.src([
        'resources/assets/js/frontend.js'
    ]).pipe(gulp.dest('public/js'));
});
