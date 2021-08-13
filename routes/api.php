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
    'namespace' => '\App\Containers'
], function () {
    Route::get('user', 'User\UI\API\Controllers\UserController@user');
    Route::put('user/info', 'User\UI\API\Controllers\UserController@updateInfo');
    Route::put('user/password', 'User\UI\API\Controllers\UserController@updatePassword');

    Route::get('export', 'Order\UI\API\Controllers\OrderController@export');
    Route::get('chart', 'Dashboard\UI\API\Controllers\DashboardController@chart');
    Route::post('upload', 'Order\UI\API\Controllers\ImageController@upload');

    Route::apiResource('users', 'User\UI\API\Controllers\UserController');
    Route::apiResource('roles', 'Role\UI\API\Controllers\RoleController');
    Route::apiResource('products', 'Product\UI\API\Controllers\ProductController');
    Route::apiResource('orders', 'Order\UI\API\Controllers\OrderController')
        ->only('index', 'show');
});
