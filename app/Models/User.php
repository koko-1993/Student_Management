<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Request;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getSingle($id)
    {
        return User::find($id);
    }

    static public function getAdmin()
    {
        $return = self::select('*');

            if(!empty(Request::get('id')))
            {
                $return = $return->where('id','=', Request::get('id'));
            }

            if(!empty(Request::get('is_admin')))
            {
                $return = $return->where('is_admin','=', Request::get('is_admin'));
            }

            if(!empty(Request::get('name')))
            {
                $return = $return->where('name','like','%'.Request::get('name').'%' );
            }

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email','like','%'.Request::get('email').'%' );
            }

            if(!empty(Request::get('address')))
            {
                $return = $return->where('address','like','%'.Request::get('address').'%' );
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

        $return = $return->whereIn('is_admin', array('1','2'))
                ->where('is_delete','=',0)
                ->orderBy('id','asc')
                ->paginate(20);
        return $return;
    }

    static public function getSchool()
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

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email','like','%'.Request::get('email').'%' );
            }

            if(!empty(Request::get('address')))
            {
                $return = $return->where('address','like','%'.Request::get('address').'%' );
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

        $return = $return->where('is_admin','=',3)
                ->where('is_delete','=',0)
                ->orderBy('id','asc')
                ->paginate(20);
        return $return;
    }

    static public function getSchoolAll()
    {
        return self::select('*')
                ->where('is_admin','=', 3)
                ->where('is_delete', '=', 0)
                ->where('status', '=', 1)
                ->orderBy('id', 'asc')
                ->get();
    }

    static public function getTeacher($user_id, $user_type)
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

            if(!empty(Request::get('lastname')))
            {
                $return = $return->where('lastname','like','%'.Request::get('lastname').'%' );
            }

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email','like','%'.Request::get('email').'%' );
            }

            if(!empty(Request::get('gender')))
            {
                $return = $return->where('gender','=', Request::get('gender'));
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

            if($user_type == 3)
            {
                $return = $return->where('created_by_id', '=', $user_id);
            }

        $return = $return->where('is_admin','=', 5)
                ->where('is_delete','=', 0)
                ->orderBy('id','asc')
                ->paginate(20);
        return $return;
    }

    static public function getStudent($user_id, $user_type)
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

            if(!empty(Request::get('lastname')))
            {
                $return = $return->where('lastname','like','%'.Request::get('lastname').'%' );
            }

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email','like','%'.Request::get('email').'%' );
            }

            if(!empty(Request::get('gender')))
            {
                $return = $return->where('gender','=', Request::get('gender'));
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

            if($user_type == 3)
            {
                $return = $return->where('created_by_id', '=', $user_id);
            }

        $return = $return->where('is_admin','=', 6)
                ->where('is_delete','=', 0)
                ->orderBy('id','desc')
                ->paginate(20);
        return $return;
    }


    static public function getParent($user_id, $user_type)
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

            if(!empty(Request::get('lastname')))
            {
                $return = $return->where('lastname','like','%'.Request::get('lastname').'%' );
            }

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email','like','%'.Request::get('email').'%' );
            }

            if(!empty(Request::get('gender')))
            {
                $return = $return->where('gender','=', Request::get('gender'));
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

            if($user_type == 3)
            {
                $return = $return->where('created_by_id', '=', $user_id);
            }

        $return = $return->where('is_admin','=', 7)
                ->where('is_delete','=', 0)
                ->orderBy('id','desc')
                ->paginate(20);
        return $return;
    }


    static public function getParentMyStudent($parent_id)
    {
        $return = self::select('*');
        $return = $return->where('parent_id', '=', $parent_id);
        $return = $return->where('is_admin','=', 6)
                ->where('is_delete','=', 0)
                ->orderBy('id','desc')
                ->get();
        return $return;
    }
    

    static public function getSchoolAdmin($user_id, $user_type)
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

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email','like','%'.Request::get('email').'%' );
            }

            if(!empty(Request::get('address')))
            {
                $return = $return->where('address','like','%'.Request::get('address').'%' );
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

            if($user_type == 3)
            {
                $return = $return->where('created_by_id', '=', $user_id);
            }

        $return = $return->where('is_admin','=', 4)
                ->where('is_delete','=', 0)
                ->orderBy('id','asc')
                ->paginate(20);
        return $return;
    }

    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }


    public function getParentData()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }


    public function getClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }


    public function getProfile()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return "";
        }
    }


    public function getProfileLive()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return url('upload/profile/user.jpg');
        }
    }
}
