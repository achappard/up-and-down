// Requirement
var gulp = require('gulp');

var requireDir = require('require-dir');
requireDir('./gulp-tasks');

// Tâche "build"
gulp.task('dev', ['front_dev', 'back_dev']);
gulp.task('prod', ['front_prod', 'back_prod']);

// Watch
gulp.task('watch', ['watch_front', 'watch_back']);

// Tâche par défaut
gulp.task('default', ['dev']);
