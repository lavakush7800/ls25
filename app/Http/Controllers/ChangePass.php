<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function CPassword(){
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request){
        $validatedata = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required | confirmed',
            'password_confirmation' => 'required',
        ]);

        $hashedpassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedpassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success','Your password is change Successfully');
        }else{
            return Redirect()->back()->with('error','Current Password is Invalid');
        }
    }
}
