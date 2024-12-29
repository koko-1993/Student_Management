<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function admin_list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['meta_title'] = "Admin";
        return view('backend.admin.list', $data);
    }

    public function create_admin()
    {
        $data['meta_title'] = "Create Admin";
        return view('backend.admin.create', $data);
    }

    public function insert_admin(Request $request)
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
        $user->is_admin = trim($request->is_admin);
        $user->created_by_id = Auth::user()->id;
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

        return redirect('panel/admin')->with('success',"Admin successfully created.");
    }


    public function edit_admin($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['meta_title'] = "Edit Admin";
        return view('backend.admin.edit', $data);
    }


    public function update_admin($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->address = trim($request->address);
        $user->status = trim($request->status);
        $user->is_admin = trim($request->is_admin);
        $user->created_by_id = Auth::user()->id;
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

        return redirect('panel/admin')->with('success',"Admin successfully updated.");
    }


    public function delete_admin($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/admin')->with('success',"Admin successfully deleted.");
    }

    
}



