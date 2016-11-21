// Requirement
var gulp = require('gulp');

// Include all plugin mentionned in package .json
var gulpLoadPlugins = require('gulp-load-plugins');
var plugins = gulpLoadPlugins({
    rename: {
        'gulp-clean-css': 'clean'
    }
});


// Path varaibles
var source = '.';		// Work directory
var destination = '../../../public/upAndDown/';	// Production directory







/**
 * Stylesheet Tasks
 */
gulp.task('css', function (){
	return gulp.src(source + '/scss/**/*.scss')
        //Compilation des fichiers scss
        //.pipe(plugins.sass().on('error', plugins.sass.logError))

        .pipe(plugins.compass({
            comments: true,
            css: destination +'/css',
            sass: source + '/scss'
        }))
        .on('error', function(err) {
            console.log("OUPS");
            console.log(err);
            this.emit('end');
        })

        //Formattage des css compilé
        .pipe( plugins.csscomb())
    
        .pipe(plugins.cssbeautify({
            indent: '  ',
            openbrace: 'separate-line',
            autosemicolon: true
        }))
    
        .pipe(plugins.autoprefixer())

        //  ecriture
		.pipe(gulp.dest(destination +'/css'));
});

gulp.task('copyVegasAssets', function () {
    console.log("Copie des ressource pour Vegas....");

    gulp.src( source + '/bower_components/vegas/dist/vegas.min.css')
        .pipe(gulp.dest(destination + '/css'));
    console.log("    -> Copie des styles vegas.min.css");


    gulp.src( source + '/bower_components/vegas/dist/vegas.min.js')
        .pipe(gulp.dest(destination + '/js'));
    console.log("    -> Copie du plugin jQuery vegas.min.js");


})


gulp.task('minify', function () {
  return gulp.src(destination + '/css/upanddown.css')
    .pipe(plugins.clean())
    .pipe(plugins.rename('upanddown.min.css'))
    .pipe(gulp.dest(destination + '/css/'));
});



/**
 * JavaScript Tasks
 */
// Cancat
gulp.task('scripts', function() {
    return gulp.src([source + '/js/module.js', source + '/js/master.js'])
        .pipe(plugins.jshint())
        .pipe(plugins.jshint.reporter('default'))
        .pipe(plugins.concat('upanddown.js'))
        .pipe(gulp.dest(destination + '/js'));
});

// Cancat
gulp.task('scripts_prod', function() {
    return gulp.src([source + '/js/module.js', source + '/js/master.js'])
        .pipe(plugins.jshint())
        .pipe(plugins.jshint.reporter('default'))
        .pipe(plugins.concat('upanddown.min.js', {newLine: ';'}))
        .pipe(plugins.uglify())

        .pipe(gulp.dest(destination + '/js'));
});




// Tâche "build"
gulp.task('build', ['css','copyVegasAssets', 'scripts']);

// Tâche "prod" = Build + minify
gulp.task('prod', ['css','copyVegasAssets',  'minify', 'scripts_prod']);

// Tâche par défaut
gulp.task('default', ['build']);





gulp.task('watch', function () {
  gulp.watch(source + '/scss/**/*.scss', ['css']);
  gulp.watch(source + '/js/**/*.js', ['scripts']);
});
