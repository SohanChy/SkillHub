<?php

namespace App\Http\Controllers\Web\Open\Auth;

use App\User;
use Barryvdh\Debugbar\Middleware\Debugbar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    public function __construct()
    {
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

    public function show()
    {
        $user = Auth::user();
        return view('open.auth.view_profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('open.auth.update', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $rules= [
            'name' => 'required|max:191',
            'mobile' => 'required|max:191',
            'email' => 'required|email',
            'previous_password' => 'nullable|min:8',
            'new_password' => 'nullable|confirmed|min:8',
        ];

        $this->validate($request,$rules);

        //If new value
        $newRules = [];
        if($request->mobile != $user->mobile){
            $newRules['mobile'] = 'unique:users';
        }
        if($request->email != $user->email){
            $newRules['email'] = 'unique:users';
        }
        if(count($newRules)){
            $this->validate($request,$newRules);
        }


        if ($request->hasFile('file')) {
            $img = $request->file('file');

            $imgname = $user->id . '.' . $img->getClientOriginalExtension();;

            $destinationPath = public_path(User::$proPicDirPath);

            if($user->pro_pic_url != User::defaultImage()){
                unlink(public_path(User::$proPicDirPath . $user->pro_pic));
            }

            $request->file('file')->move($destinationPath,$imgname );
            $user->pro_pic = $imgname;
        }

        $user->name = $request->name;


        if($request->new_password){

            if(Hash::check($request->previous_password,$user->password))
            {
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->password = bcrypt($request->new_password);
            }
            else
            {
                return Redirect::back()->withErrors(['Wrong old password']);
            }
        }


        $user->save();

        //return "Profile update successful ";
        return redirect('/profile/me');
    }



}
