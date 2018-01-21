<?php

namespace App\Http\Controllers\Web\Open\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

        $categoryNavData = Cache::remember('categoryNavData', 15, function () {

            $categoryNavData = DB::table('categories')
                ->join('courses', 'categories.id', '=', 'courses.category_id')
                ->join('course_teacher', 'courses.id', '=', 'course_teacher.course_id')
                ->join('users', 'course_teacher.teacher_id', '=', 'users.id')
                ->select('courses.id as course_id','courses.title as course_title','courses.rating as course_rating',
                    'categories.id as category_id', 'categories.name as category_name',
                    'users.name as teacher_name','users.edu_stat as teacher_edu')
                ->get();

            return $categoryNavData->groupBy('category_id')->toArray();
        });

        /*
            dd($categoryNavData);*/

        View::share('categoryNavData', $categoryNavData);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('open.auth.login');
    }


    public function username()
    {
        return 'mobile';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     * @return string
     */
    protected function redirectTo()
    {
        return User::redirectRoleLogic();
    }

}