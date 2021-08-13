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

    Route::apiResource('users', '\App\Containers\User\UI\API\Controllers\UserController');
    Route::apiResource('roles', '\App\Containers\Role\UI\API\Controllers\RoleController');
    Route::apiResource('products', '\App\Containers\Product\UI\API\Controllers\ProductController');
    Route::apiResource('orders', '\App\Containers\Order\UI\API\Controllers\OrderController')
        ->only('index', 'show');
});
