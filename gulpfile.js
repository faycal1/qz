var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix
        // Copy webfont files from /vendor directories to /public directory.
        .copy('vendor/fortawesome/font-awesome/fonts', 'public/build/fonts/font-awesome')
        .copy('vendor/twbs/bootstrap-sass/assets/fonts/bootstrap', 'public/build/fonts/bootstrap')
        .copy('vendor/twbs/bootstrap/dist/js/bootstrap.min.js', 'public/js/vendor')

        .sass([ // Process front-end stylesheets
                'frontend/main.scss'
            ], 'resources/assets/css/frontend/main.css')
        .styles([  // Combine pre-processed CSS files
                'frontend/main.css',
                'frontend/style.css',
                'frontend/quiz/styles.css',
            ], 'public/css/frontend.css')
        .scripts([ // Combine front-end scripts
                'plugins.js',
                'frontend/main.js',
                'frontend/quiz/essemble_core.min.js',
                'frontend/quiz/jquery.easing.1.3.js',
                'frontend/quiz/jquery.transit.min.js',
                'frontend/quiz/mcq.js',
                'frontend/quiz/quiz.js'
            ], 'public/js/frontend.js')

        .sass([ // Process back-end stylesheets
            'backend/main.scss',            
            'backend/skin.scss',
            'backend/plugin/toastr/toastr.scss'
        ], 'resources/assets/css/backend/main.css')
        .styles([ // Combine pre-processed CSS files
                'backend/main.css',
                'sweetalert.css',
                'backend/dropzone.css',
                'backend/jquery.dataTables.min.css',                
                'backend/datatables.min.css',
                'backend/select2/select2.min.css',
                'backend/basic.css',
            ], 'public/css/backend.css')
        .scripts([ // Combine back-end scripts
                'sweetalert.min.js',
                'plugins.js',                                
                'backend/main.js',
                'backend/plugin/toastr/toastr.min.js',
                'backend/plugin/dropzone/dropzone.js',
                'backend/plugin/datatables/jquery.dataTables.min.js',
                'backend/plugin/select2/select2.full.min.js',
                'fc/fusioncharts.js',
                'fc/fusioncharts.charts.js',
                'fc/fusioncharts.powercharts.js',
                'fc/fusioncharts.gantt.js',
                'fc/fusioncharts.maps.js',
                'fc/fusioncharts.widgets.js',
                'fc/themes/fusioncharts.theme.fint.js',
                'backend/custom.js'
            ], 'public/js/backend.js')

        // Apply version control
        .version(["public/css/frontend.css", "public/js/frontend.js", "public/css/backend.css", "public/js/backend.js"]);
});

/**
 * Uncomment for LESS version
 */
/*elixir(function(mix) {
    mix
        // Copy webfont files from /vendor directories to /public directory.
        .copy('vendor/fortawesome/font-awesome/fonts', 'public/build/fonts/font-awesome')
        .copy('vendor/twbs/bootstrap/fonts', 'public/build/fonts/bootstrap')
        .copy('vendor/twbs/bootstrap/dist/js/bootstrap.min.js', 'public/js/vendor')

        .less([ // Process front-end stylesheets
            'frontend/main.less'
        ], 'resources/assets/css/frontend/main.css')
        .styles([  // Combine pre-processed CSS files
            'frontend/main.css'
        ], 'public/css/frontend.css')
        .scripts([ // Combine front-end scripts
            'plugins.js',
            'frontend/main.js'
        ], 'public/js/frontend.js')

        .less([ // Process back-end stylesheets
            'backend/AdminLTE.less',
            'backend/plugin/toastr/toastr.less'
        ], 'resources/assets/css/backend/main.css')
        .styles([ // Combine pre-processed CSS files
            'backend/main.css'
        ], 'public/css/backend.css')
        .scripts([ // Combine back-end scripts
            'plugins.js',
            'backend/main.js',
            'backend/plugin/toastr/toastr.min.js',
            'backend/custom.js'
        ], 'public/js/backend.js')

        // Apply version control
        .version(["public/css/frontend.css", "public/js/frontend.js", "public/css/backend.css", "public/js/backend.js"]);
});*/
