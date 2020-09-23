<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){
    /**Formulário de login */
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.do');

    /**Rotas Protegidas */

    Route::group(['middleware' => ['auth']], function() {

        //     /**Dashboard Home */
        Route::get('home', 'AuthController@home')->name('home');

        Route::resource('employees', 'EmployeeController');
        Route::resource('companies', 'CompanyController');

        //     Route::get('users/team', 'UserController@team')->name('users.team');
        //     Route::resource('users', 'UserController');

    });


    // /**Logout */
    Route::get('logout', 'AuthController@logout')->name('logout');
});
