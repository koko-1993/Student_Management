<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class ClassTeacherModel extends Model
{
    protected $table = 'class_teacher';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function checkClassTeacher($created_by_id, $class_id, $teacher_id)
    {
        return ClassTeacherModel::where('created_by_id','=',$created_by_id)
                        ->where('class_id', '=', $class_id)
                        ->where('teacher_id', '=',$teacher_id)
                        ->where('is_delete', '=', 0)
                        ->count();
    }

    static public function getSelectedTeacher($class_id, $created_by_id)
    {
        return ClassTeacherModel::select('class_teacher.*','users.name as teacher_name')
                        ->join('users', 'users.id', '=', 'class_teacher.teacher_id')
                        ->where('class_teacher.created_by_id','=',$created_by_id)
                        ->where('class_teacher.class_id', '=', $class_id)
                        ->where('class_teacher.is_delete', '=', 0)
                        ->get();
    }

    static public function deleteClassTeacher($class_id, $created_by_id)
    {
        return ClassTeacherModel::where('created_by_id','=',$created_by_id)
                        ->where('class_id', '=', $class_id)
                        ->delete();
    }


    static public function getRecord($user_id, $user_type)
    {
        $return = self::select('class_teacher.*','class.name as class_name', 'users.name as teacher_name', 'users.lastname as teacher_lastname');
            $return = $return->join('class', 'class.id', '=', 'class_teacher.class_id');
            $return = $return->join('users', 'users.id', '=', 'class_teacher.teacher_id');
            if(!empty(Request::get('id')))
            {
                $return = $return->where('class_teacher.id','=', Request::get('id'));
            }

            if(!empty(Request::get('class_name')))
            {
                $return = $return->where('class.name','like','%'.Request::get('class_name').'%' );
            }

            if(!empty(Request::get('teacher_name')))
            {
                $return = $return->where('users.name','like','%'.Request::get('teacher_name').'%' );
            }

            if(!empty(Request::get('status')))
            {

                $status = Request::get('status');

                if($status == 100)
                {
                    $status = 0;
                }
                $return = $return->where('class_teacher.status','=', $status);
            }

            $return = $return->where('class_teacher.created_by_id', '=', $user_id);

        $return = $return->where('class_teacher.is_delete', '=', 0)
                ->orderBy('class_teacher.id','asc')
                ->paginate(20);
        return $return;
    }
}
