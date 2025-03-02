<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use Str;
use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassTimeTableModel;
use App\Models\SubjectModel;
use App\Models\SubjectClassModel;
use App\Models\WeekModel;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function subject_list()
    {
        $data['getRecord'] = SubjectModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Subject";
        return view('backend.subject.list', $data);
    }

    public function create_subject()
    {
        $data['meta_title'] = "Create Subject";
        return view('backend.subject.create', $data);
    }

    public function insert_subject(Request $request)
    {
        $save               = new SubjectModel;
        $save->name         = trim($request->name);
        $save->type         = trim($request->type);
        $save->status       = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

        return redirect('panel/subject')->with('success',"Subject successfully created.");
    }


    public function edit_subject($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);
        $data['meta_title'] = "Edit Subject";
        return view('backend.subject.edit', $data);
    }


    public function update_subject($id, Request $request)
    {

        $save = SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->save();

        return redirect('panel/subject')->with('success',"Subject successfully updated.");
    }


    public function delete_subject($id)
    {
        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/subject')->with('success',"Subject successfully deleted.");
    }


    public function assign_subject_list(Request $request)
    {
        $data['getRecord'] = SubjectClassModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Assign Subject Class";
        return view('backend.assign_subject.list', $data);
    }

    public function create_assign_subject()
    {
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getRecordActive(Auth::user()->id);
        
        $data['meta_title'] = "Create Assign Subject Class";
        return view('backend.assign_subject.create', $data);
    }


    public function insert_assign_subject(Request $request)
    {
        if(!empty($request->class_id) && !empty($request->subject_id))
        {
           foreach($request->subject_id as $subject_id) 
           {
            
                if(!empty($subject_id))
                {
                    $check  = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);
                    if(empty($check))
                    {
                        $save               = new SubjectClassModel;
                        $save->class_id     = trim($request->class_id);
                        $save->subject_id   = trim($subject_id);
                        $save->status       = trim($request->status);
                        $save->created_by_id= Auth::user()->id;
                        $save->save();
                    }
                }

           }
        }

        return redirect('panel/assign-subject')->with('success',"Assign Subject Class Created Successfully"); 
    }


    public function edit_single_assign_subject($id)
    {
        $data['getRecord'] = SubjectClassModel::getSingle($id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getRecordActive(Auth::user()->id);
        
        $data['meta_title'] = "Edit Assign Subject Class";
        return view('backend.assign_subject.edit_single', $data);
    }


    public function update_single_assign_subject(Request $request)
    {
        $check  = SubjectClassModel::checkClassSubjectSingle(Auth::user()->id, $request->class_id, $request->subject_id);
        if(empty($check))
        {
            $check               = new SubjectClassModel();
            $check->class_id     = trim($request->class_id);
            $check->subject_id   = trim($request->subject_id);
            $check->status       = trim($request->status);
            $check->created_by_id= Auth::user()->id;
            $check->save();
        }
        else
        {
            $check->class_id     = trim($request->class_id);
            $check->subject_id   = trim($request->subject_id);
            $check->status       = trim($request->status);
            $check->save();
        }
        return redirect('panel/assign-subject')->with('success',"Assign Subject Class Updated Successfully");
    }


    public function edit_assign_subject($id)
    {
        $getRecord = SubjectClassModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSelectedSubject'] = SubjectClassModel::getSelectedSubject($getRecord->class_id, Auth::user()->id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getRecordActive(Auth::user()->id);
        
        $data['meta_title'] = "Edit Assign Subject Class";
        return view('backend.assign_subject.edit', $data);
    }

    public function update_assign_subject($id, Request $request)
    {
        if(!empty($request->class_id))
        {
            SubjectClassModel::deleteClassSubject($request->class_id, Auth::user()->id);
           foreach($request->subject_id as $subject_id) 
           {
            
                if(!empty($subject_id))
                {
                    $check  = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);
                    if(empty($check))
                    {
                        $save               = new SubjectClassModel();
                        $save->class_id     = trim($request->class_id);
                        $save->subject_id   = trim($subject_id);
                        $save->status       = trim($request->status);
                        $save->created_by_id= Auth::user()->id;
                        $save->save();
                    }
                }

           }
        }

        return redirect('panel/assign-subject')->with('success',"Assign Subject Class Updated Successfully"); 
    }

    public function delete_assign_subject($id)
    {
        $save = SubjectClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/assign-subject')->with('success',"Assign Subject Class Deleted Successfully.");
    }


    public function class_timetable(Request $request)
    {
        if(!empty($request->class_id))
        {
            // dd($request->all());
            $getSubject = SubjectClassModel::getSelectedSubject($request->class_id, Auth::user()->id);
        }
        else
        {
            $getSubject = '';
        }

        $data['getSubject'] = $getSubject;

        $result = array();
        $getWeek = WeekModel::getRecord();
        foreach($getWeek as $week)
        {
            $arraydata = array();
            $arraydata['id'] = $week->id;
            $arraydata['week_name'] = $week->name;

            if(!empty($request->class_id) && !empty($request->subject_id))
            {
                $getClassTimeTable = ClassTimeTableModel::getRecord($request->class_id, $request->subject_id, $week->id);
                if(!empty($getClassTimeTable))
                {
                    $arraydata['start_time'] = $getClassTimeTable->start_time; 
                    $arraydata['end_time'] = $getClassTimeTable->end_time; 
                    $arraydata['room_number'] = $getClassTimeTable->room_number; 
                }
                else
                {
                    $arraydata['start_time'] = ''; 
                    $arraydata['end_time'] = ''; 
                    $arraydata['room_number'] = ''; 
                }
            }
            else
            {
                $arraydata['start_time'] = ''; 
                $arraydata['end_time'] = ''; 
                $arraydata['room_number'] = ''; 
            }

            $result[] = $arraydata;
        }

        $data['getRecord'] = $result;

        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Class Timetable";
        return view('backend.class_timetable.list', $data);
    }

    public function submit_class_timetable(Request $request)
    {
        if(!empty($request->class_id) && !empty($request->subject_id))
        {
            ClassTimeTableModel::DeleteRecord($request->class_id, $request->subject_id);

            foreach($request->timetable as $timetable)
            {
                if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']))
                {
                    $save = new ClassTimeTableModel();
                    $save->week_id = $timetable['week_id'];
                    $save->start_time = $timetable['start_time'];
                    $save->end_time = $timetable['end_time'];
                    $save->room_number = $timetable['room_number'];
                    $save->class_id = $request->class_id;
                    $save->subject_id = $request->subject_id;
                    $save->save();
                }
            }

            return redirect()->back()->with('success',"Class Timetable Updated Successfully.");
        }
        else
        {
            return redirect()->back()->with('error',"Please Select Class and Subject");
        }
        
    }

    public function get_assign_subject_class(Request $request)
    {
        $getSubject = SubjectClassModel::getSelectedSubject($request->class_id, Auth::user()->id);

        $html = '';
        $html .= '<option value="">Select</option>';
        foreach($getSubject as $subject){
            $html .= '<option value="'.$subject->subject_id.'">'.$subject->subject_name.'</option>';
        }

        $json['success'] = $html;
        echo json_encode($json);
    }

    
}



