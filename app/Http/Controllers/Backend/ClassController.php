<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassTeacherModel;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    public function class_list()
    {
        $data['getRecord'] = ClassModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Class";
        return view('backend.class.list', $data);
    }

    public function create_class()
    {
        $data['meta_title'] = "Create Class";
        return view('backend.class.create', $data);
    }

    public function insert_class(Request $request)
    {
        $save               = new ClassModel;
        $save->name         = trim($request->name);
        $save->status       = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

        return redirect('panel/class')->with('success',"Class successfully created.");
    }


    public function edit_class($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);
        $data['meta_title'] = "Edit Class";
        return view('backend.class.edit', $data);
    }


    public function update_class($id, Request $request)
    {

        $save = ClassModel::getSingle($id);
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save->save();

        return redirect('panel/class')->with('success',"Class successfully updated.");
    }


    public function delete_class($id)
    {
        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/class')->with('success',"Class successfully deleted.");
    }


    public function assign_class_teacher_list(Request $request)
    {
        $data['getRecord'] = ClassTeacherModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Assign Class Teacher";
        return view('backend.assign_class_teacher.list', $data);
    }

    public function create_assign_class_teacher(Request $request)
    {
        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Create Assign Class Teacher";
        return view('backend.assign_class_teacher.create', $data);
    }


    public function insert_assign_class_teacher(Request $request)
    {
        if(!empty($request->class_id) && !empty($request->teacher_id))
        {
           foreach($request->teacher_id as $teacher_id) 
           {            
                if(!empty($teacher_id))
                {
                    $check  = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);
                    if(empty($check))
                    {
                        $save               = new ClassTeacherModel();
                        $save->class_id     = trim($request->class_id);
                        $save->teacher_id   = trim($teacher_id);
                        $save->status       = trim($request->status);
                        $save->created_by_id= Auth::user()->id;
                        $save->save();
                    }
                }
           }
        }

        return redirect('panel/assign-class-teacher')->with('success',"Assign Class Teacher Created Successfully"); 
    }


    public function edit_single_assign_class_teacher($id)
    {
        $data['getRecord'] = ClassTeacherModel::getSingle($id);
        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);

        $data['meta_title'] = "Edit Single Assign Class Teacher";
        return view('backend.assign_class_teacher.edit_single', $data);
    }

    public function update_single_assign_class_teacher(Request $request)
    {
        $check  = ClassTeacherModel::checkClassTeacherSingle(Auth::user()->id, $request->class_id, $request->teacher_id);
        if(empty($check))
        {
            $save               = new ClassTeacherModel();
            $save->class_id     = trim($request->class_id);
            $save->teacher_id   = trim($request->teacher_id);
            $save->status       = trim($request->status);
            $save->created_by_id= Auth::user()->id;
            $save->save();
        }
        else
        {
            $check->class_id     = trim($request->class_id);
            $check->teacher_id   = trim($request->teacher_id);
            $check->status       = trim($request->status);
            $check->save();
        }
        return redirect('panel/assign-class-teacher')->with('success',"Assign Class Teacher Updated Successfully"); 
    }


    public function edit_assign_class_teacher($id)
    {
        $getRecord = ClassTeacherModel::getSingle($id);
        $data['getRecord'] = $getRecord;

        $data['getSelectedTeacher'] = ClassTeacherModel::getSelectedTeacher($getRecord->class_id, Auth::user()->id);
        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        
        $data['meta_title'] = "Edit Assign Class Teacher";
        return view('backend.assign_class_teacher.edit', $data);
    }


    public function update_assign_class_teacher(Request $request, $id)
    {
        if(!empty($request->class_id))
        {
            ClassTeacherModel::deleteClassTeacher($request->class_id, Auth::user()->id);
           foreach($request->teacher_id as $teacher_id) 
           {
            
                if(!empty($teacher_id))
                {
                    $check  = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);
                    if(empty($check))
                    {
                        $save               = new ClassTeacherModel();
                        $save->class_id     = trim($request->class_id);
                        $save->teacher_id   = trim($teacher_id);
                        $save->status       = trim($request->status);
                        $save->created_by_id= Auth::user()->id;
                        $save->save();
                    }
                }

           }
        }

        return redirect('panel/assign-class-teacher')->with('success',"Assign Class Teacher Updated Successfully"); 
    }


    public function delete_assign_class_teacher($id)
    {
        $save = ClassTeacherModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/assign-class-teacher')->with('error',"Assign Class Teacher Deleted Successfully.");
    }


    public function TeacherClassSubject()
    {
        $data['getRecord'] = ClassTeacherModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "My Class & Subject";
        return view('teacher.class_subject.list', $data);
    }


    
}



