<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class SubjectModel extends Model
{
    protected $table = 'subject';

    static public function getSingle($id)
    {
        return SubjectModel::find($id);
    }

    static public function getRecord($user_id, $user_type)
    {
        $return = self::select('*');

            if(!empty(Request::get('id')))
            {
                $return = $return->where('id','=', Request::get('id'));
            }

            if(!empty(Request::get('name')))
            {
                $return = $return->where('name','like','%'.Request::get('name').'%' );
            }

            if(!empty(Request::get('status')))
            {

                $status = Request::get('status');

                if($status == 100)
                {
                    $status = 0;
                }
                $return = $return->where('status','=', $status);
            }

            $return = $return->where('created_by_id', '=', $user_id);

        $return = $return->where('is_delete', '=', 0)
                ->orderBy('id','asc')
                ->paginate(20);
        return $return;
    }
}
