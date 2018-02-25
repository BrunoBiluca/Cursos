var gulp = require('gulp');
var concat = require('gulp-concat');
var cssmin = require('gulp-cssmin');
var uncss = require('gulp-uncss');
var browserSync = require('browser-sync').create();

gulp.task('browser-sync', function(){
	browserSync.init({ proxy: 'localhost:52780'});
    gulp.watch('./Styles/*.css', ['css']);
    gulp.watch('./Scripts/*.js', ['js']);
});

gulp.task('css', function(){
    return gulp.src([
        './node_modules/bootstrap/dist/css/bootstrap.min.css',
        './Styles/site.css'
    ])
    .pipe(concat("site.min.css"))
    .pipe(cssmin())
    .pipe(uncss({html: ['./Views/**/*.cshtml']}))
    .pipe(gulp.dest("./wwwroot/css"))
    .pipe(browserSync.stream());
});

gulp.task('js', function(){
	return gulp.src([
		'./node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/jquery-validation/dist/jquery.validate.min.js',
        './node_modules/jquery-validation-unobtrusive/jquery.validate.unobtrusive.js',
        './Scripts/site.js'
    ])
    .pipe(gulp.dest("./wwwroot/js"))
    .pipe(browserSync.stream());
});

gulp.task('fonts', function() {
	return gulp.src([
			'./node_modules/bootstrap/dist/fonts/*'
		])
		.pipe(gulp.dest('./wwwroot/fonts/'));
})