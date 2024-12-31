<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SchoolAdminController extends Controller
{

    public function school_admin_list()
    {
        $data['getRecord'] = User::getSchoolAdmin(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "School Admin";
        return view('backend.school_admin.list', $data);
    }

    public function create_school_admin()
    {
        $data['getSchool'] = User::getSchoolAll();
        $data['meta_title'] = "Create School Admin";
        return view('backend.school_admin.create', $data);
    }

    public function insert_school_admin(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);


        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->address = trim($request->address);
        $user->status = trim($request->status);
        $user->is_admin = 4;

        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
        {
            $user->created_by_id = $request->school_id;
        }
        else
        {
            $user->created_by_id = Auth::user()->id;
        }

        $user->save();

        if(!empty($request->file('profile_pic'))){

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile',$filename);

            $user->profile_pic = $filename;
            $user->save();
        }

        return redirect('panel/school_admin')->with('success',"School Admin successfully created.");
    }


    public function edit_school_admin($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['meta_title'] = "Edit School Admin";
        return view('backend.school_admin.edit', $data);
    }


    public function update_school_admin($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user           = User::getSingle($id);
        $user->name     = trim($request->name);
        $user->email    = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->address  = trim($request->address);
        $user->status   = trim($request->status);
        $user->save();

        if(!empty($request->file('profile_pic'))){

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile',$filename);

            $user->profile_pic = $filename;
            $user->save();
        }

        return redirect('panel/school_admin')->with('success',"School Admin successfully updated.");
    }


    public function delete_school_admin($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/school_admin')->with('success',"School Admin successfully deleted.");
    }

    
}




