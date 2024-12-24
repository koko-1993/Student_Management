<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(){

        // echo Hash::make(123456);
        // die;
        return view('auth.login');
    }

    public function auth_login(Request $request){        
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){

            return redirect('panel/dashboard');

        }else{

            return redirect()->back()->with('error',"Please enter current email and password");
        
        }
    }

    public function forgot(){
        return view('auth.forgot');
    }

    public function logout(){
        
        Auth::logout();
        return redirect(url(''));
    }
}
