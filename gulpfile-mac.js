/* ----------------------------------------------------------------------------------
　Plug In
---------------------------------------------------------------------------------- */
var gulp = require('gulp');
var server = require('gulp-webserver');
var sass = require('gulp-ruby-sass');
var plumber = require('gulp-plumber');
var autoprefixer = require("gulp-autoprefixer");
var pleeease = require('gulp-pleeease');
var connectSSI = require('connect-ssi');
var imagemin = require("gulp-imagemin");
var pngquant  = require('imagemin-pngquant');
var jpegtran  = require('imagemin-jpegtran');

/* ----------------------------------------------------------------------------------
　Config
---------------------------------------------------------------------------------- */
var root = "htdocs",
    config = {
        "path" : {
        "htdocs"    :root,
        "sass"      :root+"/shared/sass/",
        "css"       :root+"/shared/css/",
        "js"        :root+"/shared/js/"
    }
};

/* ----------------------------------------------------------------------------------
　Image
---------------------------------------------------------------------------------- */
gulp.task("imageMin", function() {
    gulp.src('./htdocs/images/blog_original/**/*.{png,jpg}',{ base: "./htdocs/images/blog_original/" })
		.pipe(imagemin([
			pngquant({
				quality:'65-80',
				speed:1,
				floyd:0
			}),
			jpegtran({
				quality:85,
				progressive:true
			}),
			imagemin.svgo(),
			imagemin.optipng(),
			imagemin.gifsicle()
			]
		)) 
		.pipe(gulp.dest("./htdocs/images/blog/"));
		
	gulp.src('./htdocs/wp-content/uploads_original/*.{png,jpg}',{ base: "./htdocs/wp-content/uploads_original/" })
		.pipe(imagemin([
			pngquant({
				quality:'65-80',
				speed:1,
				floyd:0
			}),
			jpegtran({
				quality:85,
				progressive:true
			}),
			imagemin.svgo(),
			imagemin.optipng(),
			imagemin.gifsicle()
			]
		)) 
		.pipe(gulp.dest("./htdocs/wp-content/uploads/"));
});

/* ----------------------------------------------------------------------------------
　Live Reload
---------------------------------------------------------------------------------- */
gulp.task('server', function() {
    gulp.src(root+'/')
        .pipe(server({
            livereload:true,
            middleware: [
                connectSSI({
                    ext: '.html',
                    baseDir: 'htdocs'
                })
            ],
            host:'web-diy.test.jp',
            port:'8082',
            open:'http://web-diy.test.jp:8082/writing.html',
        }));
});

/* ----------------------------------------------------------------------------------
　Sass
---------------------------------------------------------------------------------- */
gulp.task('sass', function() {
    gulp.src(config.path.sass+'/*')
        .pipe(plumber())
        .pipe(sass({
            //style:'expanded',
            style:'compressed',
            'sourcemap=none': true,
            sourcemapPath:'dest',
            noCache:true
        }))
        .on('error',function (err){console.log(err.message);})
        .pipe(gulp.dest(config.path.css));
});

/* ----------------------------------------------------------------------------------
　Autoprefixer
---------------------------------------------------------------------------------- */
gulp.task('auto', function () {
    return gulp.src(config.path.css+'*.css')
        .pipe(autoprefixer({
            browsers: ['last 2 versions','Android 2.2','IE 9'],
            cascade: false
        }))
        .pipe(gulp.dest(config.path.css))
});

/* ----------------------------------------------------------------------------------
　Default Task
---------------------------------------------------------------------------------- */
gulp.task('default',['server'],function() {
    gulp.watch(config.path.sass+'/*',["sass"]);
    gulp.watch(config.path.css+'/*',["auto"]);
});