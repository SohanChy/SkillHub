<?php

namespace App\Http\Controllers\Web\Open\Auth;

use App\StatusHelper;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('open.auth.register');
    }


    protected function redirectTo()
    {
        return User::redirectRoleLogic();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:191',
            'mobile' => 'required|max:191|unique:users',
            'email' => 'required|email|unique:users',
            'type' => 'required|in:student,teacher',
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'role' => $data['type'],
                'password' => bcrypt($data['password']),
                'status' => StatusHelper::getStatusKey("approved",User::$statusArr)
            ]
        );

    }
}
