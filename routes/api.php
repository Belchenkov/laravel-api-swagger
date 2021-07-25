<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('users', 'UserController');
});
