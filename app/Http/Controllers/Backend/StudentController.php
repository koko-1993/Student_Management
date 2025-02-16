<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function student_list()
    {
        $data['getRecord'] = User::getStudent(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Student";
        return view('backend.student.list', $data);
    }

    public function create_student()
    {
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSchool'] = User::getSchoolAll();
        $data['meta_title'] = "Create Student";
        return view('backend.student.create', $data);
    }

    public function insert_student(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name             = trim($request->name);
        $user->lastname         = trim($request->lastname);
        $user->admission_number = trim($request->admission_number);
        $user->roll_number      = trim($request->roll_number);
        $user->class_id         = trim($request->class_id);
        $user->gender           = trim($request->gender);
        $user->dob              = trim($request->dob);
        $user->caste            = trim($request->caste);
        $user->religion         = trim($request->religion);
        $user->mobile_number    = trim($request->mobile_number);
        $user->admission_date   = trim($request->admission_date);
        $user->blood_group      = trim($request->blood_group);
        $user->height           = trim($request->height);
        $user->weight           = trim($request->weight);
        $user->address          = trim($request->address);
        $user->parmanentaddress = trim($request->parmanentaddress);
        $user->email            = trim($request->email);
        $user->password         = Hash::make($request->password);
        $user->status           = trim($request->status);
        $user->is_admin         = 6;
        
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

        return redirect('panel/student')->with('success',"Student created successfully.");
    }

    
}


