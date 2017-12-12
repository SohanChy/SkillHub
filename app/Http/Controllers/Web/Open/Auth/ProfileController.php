<?php

namespace App\Http\Controllers\Web\Open\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('open.auth.update', compact('user'));
    }


    public function update(Request $request)
    {
        $rules= [
            'name' => 'required|max:191',
            'mobile' => 'required|max:191|unique:users',
            'email' => 'required|email|unique:users',
            'previous_password' => 'nullable|min:8',
            'new_password' => 'nullable|confirmed|min:8',
        ];

        $this->validate($request,$rules);


        $user = Auth::user();
        if(Hash::check($request->previous_password,$user->password))
        {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = bcrypt($request->new_password);

            $user->save();

            //return "Profile update successful ";
            return redirect('/');
        }
        else
        {
            return Redirect::back()->withErrors(['Wrong old password']);
        }
    }



}
