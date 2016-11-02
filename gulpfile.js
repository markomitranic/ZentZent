// The input SCSS files and the SCSS output path
var scssInput = [
	'scss/style.scss',
	'scss/print.scss'
	];
var scssOutput = 'app/wp-content/themes/ZentZent/css';

// Start everything up.
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');


// Watch SASS.
gulp.task('sass', function() {
  return gulp.src(scssInput)
    .pipe(sass())
	.pipe(autoprefixer())
    .pipe(gulp.dest(scssOutput))
});



gulp.task('watch', ['sass'], function (){
  gulp.watch('scss/**/*.scss', ['sass']); 
});