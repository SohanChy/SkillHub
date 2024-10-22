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

    Route::get('/', "HomeController@index");


    Route::get('/courses', "HomeController@courseList");
    Route::get('/live-streams', "LiveStreamController@liveStreams");

    Route::group([
        'middleware' => ['auth'],
    ], function () {
        Route::get('/courses/{id}/lesson/{lesson}', "LessonController@lessonPage");
        Route::get('/courses/checkout/{id}', "LessonController@checkout")->name("courses.checkout");
        Route::post('/courses/enroll', "LessonController@enrollStudent")->name("courses.enroll");
    });

    Route::get('/courses/{id}/{slug?}', "CourseController@coursePage")->name("course");
    Route::get('/courses-video/{id}', "CourseController@getVideo");


    Route::get('login', "Auth\LoginController@showLoginForm")->name("login");
    Route::get('register', "Auth\RegisterController@showRegistrationForm")->name("register");
    Route::post('logout', "Auth\LoginController@logout")->name("logout");
    Route::post('login', "Auth\LoginController@login");
    Route::post('register', "Auth\RegisterController@register");


//    Route::get('/comments/lesson/{id}', "CommentController@courseIndex");

});


Route::group([
'namespace' => 'Web\Open\Auth',
'middleware' => 'auth'
], function () {
    Route::resource('profile',"ProfileController");
});


Route::group([
'namespace' => 'Web\Open',
'middleware' => 'auth'
], function () {
    Route::resource('comments',"CommentController");


    Route::get('/checkout-stream/{id}', "LiveStreamController@checkout");
    Route::post('/checkout-stream/{id}', "LiveStreamController@checkoutDone");
    Route::get('/stream-now/{id}', "LiveStreamController@streamNow");
});



Route::group([
'namespace' => 'Web\Student',
'middleware' => ['auth', 'check.role:student'],
'prefix' => 'student'
], function () {
    //Student Routes Here
    Route::get('/', function () {
        return redirect('/student/courses/enrolled');
    });

    Route::get('/courses/enrolled', "CourseController@enrolled");
    Route::get('/courses/current', "CourseController@current");
    Route::get('/get-video/{video}', 'CourseController@getVideo');

});


Route::group([
'namespace' => 'Web\Teacher',
'middleware' => ['auth', 'check.role:teacher'],
'prefix' => 'teacher',
'as' => 'teacher.'
], function () {
    Route::get('/lesson/create/{id}', "LessonController@create");

    Route::get('/summernote', "LessonController@getSummernote");
    Route::post('/summernote', "LessonController@postSummernote");
    Route::post('/uploadResource', "LessonController@resourceUpload");
    Route::post('/uploadVideo', "LessonController@videoUpload");
    Route::get('/get-video/{video}', 'LessonController@getVideo');

    Route::get('courses/{id}/students', "CourseController@showStudents");

    Route::get('payments', "PaymentController@index")->name("teacher.payments");
    Route::post('payments', "PaymentController@payment");


    Route::resource('courses', "CourseController");
    Route::resource('lesson', "LessonController");
    
    Route::get('/', function () {
        return redirect('/teacher/courses');
    });


    //Live stream
    Route::resource('live-streams', "LiveStreamController");
});


Route::group([
'namespace' => 'Web\Admin',
'middleware' => ['auth', 'check.role:admin'],
'prefix' => 'admin',
'as' => 'admin.'
], function () {
    //Admin Routes Here
    Route::get('/', function () {
        return redirect('/admin/approval');
    });

    Route::resources([
    'category' => 'AdminCategoryController',
    'approval' => 'ApprovalController'
    ]);
});

