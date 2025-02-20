<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function my_account()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['meta_title'] = "My Account";
        return view('backend.my_account',$data);
    }

    public function update_account(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        $user->name = trim($request->name);
        if(Auth::user()->is_admin != 3)
        {
            $user->lastname = trim($request->lastname);
        }

        if(!empty($request->file('profile_pic'))){

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile',$filename);

            $user->profile_pic = $filename;
        }

        $user->save();

        return redirect()->back()->with('success','Account Successfully Updated');
    }

    public function change_password()
    {
        $data['meta_title'] = "Change Password";
        return view('backend.change_password',$data);
    }

    public function update_password(Request $request)
    {
        if($request->new_password == $request->confrim_password)
        {
            $user = User::getSingle(Auth::user()->id);

            if(Hash::check($request->old_password,$user->password))
            {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success','Password Successfully Update!');
            }
            else
            {
                return redirect()->back()->with('error','Old Password is not correct!');
            }
        }
        else
        {
            return redirect()->back()->with('error','New Password and Confirm Password does not match!');
        }
    }
}


