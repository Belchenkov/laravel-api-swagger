<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'UserController@user');
    Route::put('user/info', 'UserController@updateInfo');
    Route::put('user/password', 'UserController@updatePassword');

    Route::apiResource('users', 'UserController');
    Route::apiResource('roles', 'RoleController');
    Route::apiResource('products', 'ProductController');
});
