<?php

namespace App\Http\Controllers\Web\Open\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;



class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if($user->pro_pic==Null)
            $user->pro_pic="default.png";

        return view('open.auth.view_profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        if($user->pro_pic==Null)
            $user->pro_pic="default.png";

        return view('open.auth.update', compact('user'));
    }

    public function store(Request $request)
    {



        $rules=[
            'name' => 'required|max:191',
            'mobile' => 'required|max:191',
            'email' => 'required|email',
            'file'=>'max:1000000|image:jpg,png',
            'previous_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|min:8',
        ];
        $validator = Validator::make($request->all(),$rules);

        if(!($validator->fails())) {

            $user = Auth::user();

            if ($request->hasFile('file')) {
                $img = $request->file('file');

                $imgname = $user->id . '.' . $img->getClientOriginalExtension();;

                $destinationPath = public_path('/img/profile');

                unlink(public_path('/img/profile/'.$user->pro_pic));

                $request->file('file')->move($destinationPath,$imgname );
                $user->pro_pic = $imgname;
            }

            if (Hash::check($request->previous_password, $user->password)) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;

                $user->password = bcrypt($request->new_password);
                $user->save();
            }
            else{
                return Redirect::back()->withErrors(['Wrong old password']);
            }

            //return "Profile update successful ";
            return redirect('/profile/me');
        }
        else
            return Redirect::back()->withErrors(['validation error']);
    }







}
