<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(
    ['prefix' => 'api', 'middleware' => 'jwt.auth'],
    function () {
        Route::get('blog-post', 'BlogController@user_blogs');
        Route::get('blog-post/{id}', 'BlogController@user_single_blog');
        Route::post('blog-post', 'BlogController@create_blog_post');
        Route::put('blog-post/{id}', 'BlogController@update_blog_post');
        Route::delete('blog-post/{id}', 'BlogController@delete_blog_post');
    }
);
$router->post('login', ['uses' => 'AuthController@login']);
$router->post('register', ['uses' => 'UserController@register_user']);
