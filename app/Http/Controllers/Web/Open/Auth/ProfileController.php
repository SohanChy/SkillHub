<?php

namespace App\Http\Controllers\Web\Open\Auth;

use App\User;
use Barryvdh\Debugbar\Middleware\Debugbar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
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
