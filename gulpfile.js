(() => {
    'use strict';

    /*
     * ----------------------------------------------------------------------------------
     * Package
     * ----------------------------------------------------------------------------------
     */
    const gulp = require('gulp');
    const sass = require('gulp-sass');
    const csscomb = require('gulp-csscomb');
    const autoprefixer = require('gulp-autoprefixer');
    const plumber = require('gulp-plumber');
    const postcss = require('gulp-postcss');
    const mqpacker = require('css-mqpacker');
    const lineEndingCorrector = require('gulp-line-ending-corrector');
    const header = require('gulp-header');
    const replace = require('gulp-replace');
    const browser = require('browser-sync').create();
    const connectSSI = require('connect-ssi');
    const path = require('path');
    const imagemin = require('gulp-imagemin');
    const mozjpeg = require('imagemin-mozjpeg');
    const pngquant = require('imagemin-pngquant');

    /*
     * ----------------------------------------------------------------------------------
     * Config
     * ----------------------------------------------------------------------------------
     */

    // gulpfile.jsからの相対パス指定で各ディレクトリまでのパスを設定。(案件ごとに設定)
    const PATHS = {
        projectRoot: 'htdocs/',
        img: 'htdocs/shared/images',
        js: 'htdocs/shared/js',
        sassCommon: '_dev/scss/siteCommon',// サイト全体のSCSSスタイル
        css: 'htdocs/shared/css'
    };

    /*
     * ----------------------------------------------------------------------------------
     * Sass（サイト全体の共通スタイル）
     * ----------------------------------------------------------------------------------
     */
    gulp.task('CSS_COMMON_BUILD', () => gulp.src(`${PATHS.sassCommon}/**/*.scss`).
        pipe(sass({
            outputStyle: 'compressed'
        })).
        pipe(plumber({
            errorHandler: (err) => {
                // eslint-disable-next-line no-console
                console.log(err.messageFormatted);
                this.emit('end');
            }
        })).
        
        pipe(autoprefixer()).
        pipe(csscomb()).
        pipe(postcss([
            mqpacker({
                sort: true
            })
        ])).
        pipe(lineEndingCorrector({
            eolc: 'CRLF',
            encoding: 'utf8'
        })).
        pipe(replace(/@charset "UTF-8";/g, '')).
        pipe(header('@charset "UTF-8";\n\n')).
        pipe(gulp.dest(PATHS.css)));

    /*
     * ----------------------------------------------------------------------------------
     * Sass＋Live Reload
     * ----------------------------------------------------------------------------------
     */
    gulp.task('default', gulp.series(gulp.parallel('CSS_COMMON_BUILD'), () => {
        gulp.watch(`${PATHS.sassCommon}/**/*.scss`, gulp.series('CSS_COMMON_BUILD'));

    const browserReload = () => {
        browser.reload({
            stream: true
        });
    };
    browser.init({
        files: [
            'htdocs/**/*.css',
            'htdocs/**/*.js',
            'htdocs/**/*.html'
        ],

        server: {
            baseDir: 'htdocs/',
            middleware: [
              connectSSI({
                baseDir: __dirname + '/htdocs',
                ext: '.html'
              })
            ]
          }
    });
    browserReload();
    }));

    /*
     * ----------------------------------------------------------------------------------
     * css圧縮
     * ----------------------------------------------------------------------------------
     */
    gulp.task('css-min', () => gulp.src(`${PATHS.css}/**/*.css`).
        pipe(sass({
            outputStyle: 'compressed'
        })).
        pipe(gulp.dest(PATHS.css)));

    /*
     * ----------------------------------------------------------------------------------
     * 画像圧縮
     * ----------------------------------------------------------------------------------
     */
    gulp.task('imagemin', function (done) {
        gulp.src('htdocs/wp-content/uploads_original/*.{png,jpg}',{ base: "htdocs/wp-content/uploads_original/" })
            .pipe(imagemin([
                pngquant({ quality: [.65, .8], speed: 1 }),
                mozjpeg({ quality: 80 }),
                imagemin.svgo(),
                imagemin.gifsicle()
            ]
            ))
            .pipe(gulp.dest('htdocs/wp-content/uploads/'));
            done();

        gulp.src('htdocs/images/blog_original/**/*.{png,jpg}',{ base: "htdocs/images/blog_original/" })
            .pipe(imagemin([
                pngquant({ quality: [.65, .8], speed: 1 }),
                mozjpeg({ quality: 80 }),
                imagemin.svgo(),
                imagemin.gifsicle()
            ]
            ))
            .pipe(gulp.dest('htdocs/images/blog/'));
            done();
        });

})();
