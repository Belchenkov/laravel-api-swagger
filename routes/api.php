<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => '\App\Containers\User\UI\API\Controllers'
], function () {
    Route::post('login','AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::group([
    'middleware' => 'auth:api',
    'namespace' => '\App\Containers\User\UI\API\Controllers'
], function () {
    Route::get('user', 'UserController@user');
    Route::put('user/info', 'UserController@updateInfo');
    Route::put('user/password', 'UserController@updatePassword');

    Route::post('upload', 'ImageController@upload');

    Route::apiResource('users', 'UserController');
    Route::apiResource('roles', 'RoleController');
    Route::apiResource('products', 'ProductController');
});
