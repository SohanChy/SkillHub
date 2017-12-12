<?php

namespace App\Http\Controllers\Web\Open\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $name=$user->name;
        $mobile=$user->mobile;
        $type=$user->type;
        $email=$user->email;

        return view('open.auth.update', compact('name','mobile','type','email'));
    }




    public function store(Request $request)
    {
        $rules= [
            'name' => 'required|max:191',
            'mobile' => 'required|max:191|unique:users',
            'email' => 'required|email|unique:users',
            'type' => 'required|in:student,teacher',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(),$rules);
        $user = Auth::user();

        if($validator->failed())
        {
            return "validation failed";
        }

        

        elseif(Hash::check($request->previous_password,$user->password))
        {
             
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = bcrypt($request->new_password);
            $user->role = $request->type;

            $user->save();

            //return "Profile update successful ";
            return redirect('/');
        }

       else
        {return "Current password doesn't match, make sure you entered current password rightly";
         }
    }



}
