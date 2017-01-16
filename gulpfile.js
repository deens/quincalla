const elixir = require('laravel-elixir'),
    del = require('del');

require('laravel-elixir-vue-2');

elixir.extend('delete', function (path) {
    new elixir.Task('delete', function () {
        del(path);
    });
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('admin.scss')
       .sass('app.scss')
       .webpack('admin.js')
       .webpack('app.js');

    mix.version([
        'css/admin.css',
        'css/app.css',
        'js/admin.js',
        'js/app.js'
    ]);

    mix.delete([
        'public/js/admin.js',
        'public/js/app.js',
        'public/css/admin.css',
        'public/css/admin.css.map',
        'public/css/app.css',
        'public/css/app.css.map'
    ]);

    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/build/fonts/bootstrap');
});
