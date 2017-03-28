const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

var resourcesAssets = 'resources/assets/';
var dest = 'public/';
var destImg = dest + 'images/';

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
       
    // Copy images straight to public
    mix.copy(resourcesAssets + 'images', destImg);
    
    //Copy js files
    mix.copy(resourcesAssets + 'js/presentation.js', dest + 'js/');

    //Copy css files
    mix.copy(resourcesAssets + 'css/bootstrap-social.css', dest + 'css/');
});
