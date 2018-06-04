var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task("sass", function(){
    return gulp.src('resources/assets/sass/app.scss')
    .pipe(sass())
    .pipe(gulp.dest('public/css'))
});

gulp.task('default', function(){
    gulp.watch('resources/assets/sass/*.scss',['sass'])
});
// elixir(function(mix) {
//     mix.sass('app.scss');
// });