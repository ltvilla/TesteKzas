<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'api', 'as' => 'api.'], function () {

    Route::post('/auth/login', 'AuthController@login')->name('login');

    Route::group(['middleware' => ['apiProtected']], function () {
        Route::post('/me', 'AuthController@me')->name('me');
        Route::post('/auth/logout', 'AuthController@logout');

        Route::apiResource('/company', 'CompanyController');
        Route::apiResource('/employee', 'EmployeeController');
    });

});
