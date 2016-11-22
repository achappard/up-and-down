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
var back_src        = './_back';
var back_dest       = '../../public/adminLTE/';



/**
 * Copying backend bower assets
 */
gulp.task('back_assets_copy', function () {
    console.log("Backoffice : Copie des ressource css de AdminLTE....");

    //stylesheet
    gulp.src( bower_path + '/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css')
        .pipe(gulp.dest(back_dest + 'vendor/css'));
    console.log("    -> Copie des styles jquery-jvectormap-1.2.2.css");


    gulp.src( bower_path + '/AdminLTE/dist/css/AdminLTE.min.css')
        .pipe(gulp.dest(back_dest + 'vendor/css'));
    console.log("    -> Copie des styles AdminLTE.min.css");

    gulp.src( bower_path + '/AdminLTE/dist/css/skins/skin-blue.min.css')
        .pipe(gulp.dest(back_dest + 'vendor/css'));

    console.log("    -> Copie des styles skin-blue.min.css");


    gulp.src( bower_path + '/AdminLTE/bootstrap/css/bootstrap.min.css')
        .pipe(gulp.dest(back_dest + 'vendor/css'));
    console.log("    -> Copie des styles bootstrap.min.css");


    // javascript
    gulp.src( bower_path + '/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js jquery-2.2.3.min.js");

    gulp.src( bower_path + '/AdminLTE/bootstrap/js/bootstrap.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js bootstrap.min.js");

    gulp.src( bower_path + '/AdminLTE/plugins/fastclick/fastclick.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js fastclick.min.js");

    gulp.src( bower_path + '/AdminLTE/dist/js/app.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js app.min.js");

    gulp.src( bower_path + '/AdminLTE/plugins/sparkline/jquery.sparkline.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js jquery.sparkline.min.js");

    gulp.src( bower_path + '/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js jquery-jvectormap-1.2.2.min.js");

    gulp.src( bower_path + '/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js jquery-jvectormap-world-mill-en.js");

    gulp.src( bower_path + '/AdminLTE/plugins/chartjs/Chart.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js Chart.min.js");

    gulp.src( bower_path + '/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js jquery.slimscroll.min.js");

    gulp.src( bower_path + '/AdminLTE/plugins/chartjs/Chart.min.js')
        .pipe(gulp.dest(back_dest + 'vendor/js'));
    console.log("    -> Copie du script js Chart.min.js");


    gulp.src( bower_path + '/AdminLTE/bootstrap/fonts/*')
        .pipe(gulp.dest(back_dest + 'vendor/fonts'));
    console.log("    -> Copie des typos de bootstrap");
});


/**
 * Stylesheet Front Tasks
 */
gulp.task('back_css_compile', function (){
    console.log("BackOffice : Compilation des css");
    gulp.src(back_src + '/scss/**/*.scss')
    //Compilation des fichiers scss

        .pipe(plugins.compass({
            comments: true,
            css: back_dest +'/css',
            sass: back_src + '/scss'
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
        .pipe(gulp.dest(back_dest +'/css'));
    console.log("    -> ok");
});

gulp.task('back_css_minify', function () {
    console.log("BackOffice : Minification des css");
    gulp.src(back_dest + '/css/override_adminlte.css')
        .pipe(plugins.clean())
        .pipe(plugins.rename('override_adminlte.min.css'))
        .pipe(gulp.dest(back_dest + '/css/'));
    console.log("    -> ok");
});



/**
 * JavaScript Backend Tasks
 */
// Cancat
gulp.task('back_scripts', function() {
    console.log("BackOffice :Compilation des fichiers JavaScript");
    gulp.src([back_src + '/js/module.js', back_src + '/js/master.js'])
        .pipe(plugins.jshint())
        .pipe(plugins.jshint.reporter('default'))
        .pipe(plugins.concat('back_upanddown.js'))
        .pipe(gulp.dest(back_dest + '/js'));
    console.log("    -> ok");
});

// Cancat
gulp.task('back_scripts_minify', function() {
    console.log("BackOffice :Compilation et minification des fichiers JavaScript");
    gulp.src([back_src + '/js/module.js', back_src + '/js/master.js'])
        .pipe(plugins.jshint())
        .pipe(plugins.jshint.reporter('default'))
        .pipe(plugins.concat('back_upanddown.min.js', {newLine: ';'}))
        .pipe(plugins.uglify())

        .pipe(gulp.dest(back_dest + '/js'));

    console.log("    -> ok");
});



gulp.task('watch_back', function () {
    gulp.watch(back_src + '/scss/**/*.scss', ['back_css_compile']);
    gulp.watch(back_src + '/js/**/*.js', ['back_scripts']);
});

// Tâche "dev"
gulp.task('back_dev', ['back_css_compile','back_scripts', 'back_assets_copy']);

// Tâche "prod"
gulp.task('back_prod', ['back_css_compile', 'back_css_minify','back_scripts_minify', 'back_assets_copy']);