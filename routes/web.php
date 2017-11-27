<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Web\Open'
],function () {

    Route::get('/', function () {
        return view("open.welcome");
    });

    Route::get('login', "Auth\LoginController@showLoginForm")->name("login");
    Route::get('register', "Auth\RegisterController@showRegistrationForm")->name("register");
    Route::post('logout', "Auth\LoginController@logout")->name("logout");
    Route::post('login', "Auth\LoginController@login");
    Route::post('register', "Auth\RegisterController@register");


    Route::get('user', function () {
        return "You are a user. Only admins can login to web dashboard!";
    });
    Route::get('deliveryman', function () {
        return "You are a deliveryman. Only admins can login to web dashboard!";
    });

    Route::group([
        'namespace' => 'Web\Admin',
        'middleware' => ['auth', 'check.role:admin'],
        'prefix' => 'admin'
    ], function () {
        //Admin Routes Here
        Route::get('/', "DashboardController@index");
    });


});