<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\ClassModel;
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

    
}



