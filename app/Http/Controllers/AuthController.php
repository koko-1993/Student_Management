<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class AuthController extends Controller
{
    public function login(){

        // echo Hash::make(123456);
        // die;
        return view('auth.login');
    }

    public function auth_login(Request $request): RedirectResponse
    {    
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete' => 0], true))
        {

            if(Auth::user()->is_admin == 5)
            {
                return redirect('teacher/dashboard');
            }
            elseif(Auth::user()->is_admin == 6)
            {
                return redirect('student/dashboard');
            }
            elseif(Auth::user()->is_admin == 7)
            {
                return redirect('parent/dashboard');
            }
            else
            {
                return redirect('panel/dashboard');
            }
            
        }
        else{

            return redirect()->back()->with('error',"Please enter current email and password");
        
        }
    }

    public function forgot(){
        return view('auth.forgot');
    }

    public function logout()
    {    
        Auth::logout();
        return redirect(url(''));
    }
}
