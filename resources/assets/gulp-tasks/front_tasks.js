/**
 * Created by aurelienchappard on 22/11/2016.
 */
var gulp = require('gulp');


// Include all plugin mentionned in package .json
var gulpLoadPlugins = require('gulp-load-plugins');
var plugins = gulpLoadPlugins({
    rename: {
        'gulp-clean-css': 'clean'
    }
});


// Bower_path
var bower_path      = './bower_components';

// Path variable for front assets
var front_src       = './_front';
var front_dest      = '../../public/upAndDown/';


/**
 * Stylesheet Front Tasks
 */
gulp.task('front_css_compile', function (){
    console.log("FrontOffice : Compilation des css");
    gulp.src(front_src + '/scss/**/*.scss')
    //Compilation des fichiers scss

        .pipe(plugins.compass({
            comments: true,
            css: front_dest +'/css',
            sass: front_src + '/scss'
        }))
        .on('error', function(err) {
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
        .pipe(gulp.dest(front_dest +'/css'));
    console.log("    -> ok");
});

gulp.task('front_css_minify', function () {
    console.log("FrontOffice : Minification des css");
    gulp.src(front_dest + '/css/upanddown.css')
        .pipe(plugins.clean())
        .pipe(plugins.rename('upanddown.min.css'))
        .pipe(gulp.dest(front_dest + '/css/'));
    console.log("    -> ok");
});


/**
 * Copying front bower assets
 */
gulp.task('front_assets_copy', function () {
    console.log("FrontOffice : Copie des ressource pour Vegas....");

    gulp.src( bower_path + '/vegas/dist/vegas.min.css')
        .pipe(gulp.dest(front_dest + '/css/vendor/vegas'));
    console.log("    -> Copie des styles vegas.min.css");


    gulp.src( bower_path + '/vegas/dist/vegas.min.js')
        .pipe(gulp.dest(front_dest + '/js/vendor/vegas'));
    console.log("    -> Copie du plugin jQuery vegas.min.js");


    gulp.src( bower_path + '/responsive-bootstrap-toolkit/dist/bootstrap-toolkit.min.js')
        .pipe(gulp.dest(front_dest + '/js/vendor/responsive-bootstrap-toolkit'));
    console.log("    -> Copie du plugin jQuery responsive-bootstrap-toolkit");


    gulp.src( bower_path + '/bootstrap-sass/assets/fonts/bootstrap/*')
        .pipe(gulp.dest(front_dest + '/fonts/vendor/bootstrap'));
    console.log("    -> Copie des typos de bootstrap");


    gulp.src( bower_path + '/bootstrap-sass/assets/javascripts/bootstrap.min.js')
        .pipe(gulp.dest(front_dest + '/js/vendor/bootstrap'));
    console.log("    -> Copie de bootstrap.min.js");

    gulp.src( bower_path + '/blueimp-file-upload/js/jquery.iframe-transport.js')
        .pipe(gulp.dest(front_dest + '/js/vendor/jquery-fileupload'));
    console.log("    -> Copie de jquery.iframe-transport.js");

    gulp.src( bower_path + '/blueimp-file-upload/js/vendor/jquery.ui.widget.js')
        .pipe(gulp.dest(front_dest + '/js/vendor/jquery-fileupload/vendor'));
    console.log("    -> Copie de jquery.ui.widget.js");


    gulp.src( bower_path + '/blueimp-file-upload/js/jquery.fileupload.js')
        .pipe(gulp.dest(front_dest + '/js/vendor/jquery-fileupload'));
    console.log("    -> Copie de jquery.fileupload.js");


    gulp.src( bower_path + '/jquery-circle-progress/dist/circle-progress.min.js')
        .pipe(gulp.dest(front_dest + '/js/vendor/jquery-circle-progress'));
    console.log("    -> Copie de jquery-circle-progress.js");


});


/**
 * JavaScript Front Tasks
 */

// Cancat
gulp.task('front_scripts', function() {
    console.log("FrontOffice : Compilation des fichiers JavaScript");
    gulp.src([front_src + '/js/validation_form.js',front_src + '/js/module.js', front_src + '/js/master.js'])
        .pipe(plugins.jshint())
        .pipe(plugins.jshint.reporter('default'))
        .pipe(plugins.concat('upanddown.js'))
        .pipe(gulp.dest(front_dest + '/js'));
    console.log("    -> ok");
});

// Cancat
gulp.task('front_scripts_minify', function() {
    console.log("FrontOffice : Compilation et minification des fichiers JavaScript");
    gulp.src([front_src + '/js/module.js', front_src + '/js/master.js'])
        .pipe(plugins.jshint())
        .pipe(plugins.jshint.reporter('default'))
        .pipe(plugins.concat('upanddown.min.js', {newLine: ';'}))
        .pipe(plugins.uglify())

        .pipe(gulp.dest(front_dest + '/js'));

    console.log("    -> ok");
});



gulp.task('watch_front', function () {
    gulp.watch(front_src + '/scss/**/*.scss', ['front_css_compile']);
    gulp.watch(front_src + '/js/**/*.js', ['front_scripts']);
});



// Tâche "dev"
gulp.task('front_dev', ['front_css_compile','front_scripts', 'front_assets_copy']);

// Tâche "prod" = Build + minify
gulp.task('front_prod', ['front_css_compile','front_css_minify',  'front_scripts_minify', 'front_assets_copy']);