<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api','cors']], function () {
    Route::post('auth/login', 'AuthController@login');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user', 'AuthController@getAuthUser');
    });
});


Route::get('todos', 'TodoController@index');
Route::post('todos', 'TodoController@store');
Route::put('todos/{id}', 'TodoController@update');
Route::delete('todos/{id}', 'TodoController@delete');
