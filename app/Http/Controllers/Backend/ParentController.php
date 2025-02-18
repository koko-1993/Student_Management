<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function my_student($parent_id)
    {
        $data['getMyStudent'] = User::getStudent(Auth::user()->id, Auth::user()->is_admin);
        $data['getRecord'] = User::getParentMyStudent($parent_id);
        $data['meta_title'] = "Parent My Studentd";
        $data['parent_id']  = $parent_id;
        return view('backend.parent.my_student', $data); 
    }


    public function add_student($student_id,$parent_id)
    {
        $user = User::getSingle($student_id);
        $user->parent_id = $parent_id;
        $user->save();
        return redirect()->back()->with('success',"Student successfully assign.");
    }


    public function my_student_delete($student_id)
    {
        $user = User::getSingle($student_id);
        $user->parent_id = null;
        $user->save();
        return redirect()->back()->with('success',"Student successfully unassign.");
    }

    public function parent_list()
    {
        $data['getRecord'] = User::getParent(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Parent";
        return view('backend.parent.list', $data);
    }

    public function create_parent()
    {
        $data['getSchool'] = User::getSchoolAll();
        $data['meta_title'] = "Create Parent";
        return view('backend.parent.create', $data);
    }

    public function insert_parent(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name             = trim($request->name);
        $user->lastname         = trim($request->lastname);
        $user->gender           = trim($request->gender);
        $user->mobile_number    = trim($request->mobile_number);
        $user->occupation    = trim($request->occupation);
        $user->address          = trim($request->address);
        $user->parmanentaddress = trim($request->parmanentaddress);
        $user->email            = trim($request->email);
        $user->password         = Hash::make($request->password);
        $user->status           = trim($request->status);
        $user->is_admin         = 7;
        
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

        return redirect('panel/parent')->with('success',"Parent created successfully.");
    }

    public function edit_parent($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['meta_title'] = "Edit Parent";
        return view('backend.parent.edit', $data);
    }

    public function update_parent($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name             = trim($request->name);
        $user->lastname         = trim($request->lastname);
        $user->gender           = trim($request->gender);
        $user->mobile_number    = trim($request->mobile_number);
        $user->occupation    = trim($request->occupation);
        $user->address          = trim($request->address);
        $user->parmanentaddress = trim($request->parmanentaddress);
        $user->email            = trim($request->email);

        if(!empty($request->password))
        {
            $user->password         = Hash::make($request->password);
        }
        
        $user->status           = trim($request->status);

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

        return redirect('panel/parent')->with('success',"Parent Updated successfully.");
    }

    public function delete_parent($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success',"Parent successfully deleted.");
    }

    
}


