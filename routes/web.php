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

    Route::get('/courses', function () {
        $categories = \App\Category::with(['courses' => function ($query) {
            $query->where('admin_status', '1')->where('publish_status', '1');
        }])->get();
        return view("open.courses",compact('categories'));
    });

    Route::get('login', "Auth\LoginController@showLoginForm")->name("login");
    Route::get('register', "Auth\RegisterController@showRegistrationForm")->name("register");
    Route::post('logout', "Auth\LoginController@logout")->name("logout");
    Route::post('login', "Auth\LoginController@login");
    Route::post('register', "Auth\RegisterController@register");

});


Route::group([
'namespace' => 'Web\Student',
'middleware' => ['auth', 'check.role:student'],
'prefix' => 'student'
], function () {
    //Student Routes Here
    Route::get('/', function () {
        return view("student.dashboard");
    });
});

Route::group([
'namespace' => 'Web\Teacher',
'middleware' => ['auth', 'check.role:teacher'],
'prefix' => 'teacher',
'as' => 'teacher.'
], function () {
    //Student Routes Here
    Route::resource('courses', "CourseController");

    Route::get('/', function () {
        return view("teacher.dashboard");
    });
});


Route::group([
'namespace' => 'Web\Admin',
'middleware' => ['auth', 'check.role:admin'],
'prefix' => 'admin',
'as' => 'admin.'
], function () {
    //Admin Routes Here
    Route::get('/', function () {
        return view("admin.dashboard");
    });

    Route::resources([
    'category' => 'AdminCategoryController',
    'approval' => 'ApprovalController'    
    ]);
});




Route::group([
'namespace' => 'Web\Open\Auth',
'middleware' => 'auth'
], function () {

    Route::resource('profile',"UpdateController");
});
