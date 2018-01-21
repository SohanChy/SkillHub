<?php

namespace App;

use DateTime;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'password','bio','role',
        'email', 'address',
        'status', 'edu_stat'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at', 'created_at', 'bio', "pro_pic"
    ];

//    protected $appends = ['delivery_man_name', 'delivery_man_phone', "profile_picture"];


    public static function roles()
    {
        return ["student", "teacher", "admin"];
    }

    public static function redirectRoleLogic()
    {
        if (Auth::user()->hasRole("admin")) {
            return "/admin";
        } else if (Auth::user()->hasRole("teacher")) {
            return "/teacher";
        } else {
            return "/student";
        }
    }

    public function hasRole($role){

        if ($this->role == $role) {
            return true;
        }

        return false;
    }

    public static function roleErrorResponse(){

        return "You do not have permission to access this";

    }

    public static $statusArr = ["Pending", "Approved", "Rejected","Banned"];


    public static function getStatusAttribute($value)
    {
        return StatusHelper::getStatusKey($value,self::$statusArr);
    }

    public function getMyStatusKey()
    {
        return self::$statusArr[(int)$this->status];
    }

    //Relations

    public function teacherOfStreams()
    {
        return $this->hasMany('App\LiveStream', 'teacher_id');
    }

    public function teacherOfCourses()
    {
        return $this->belongsToMany('App\Course', 'course_teacher', 'teacher_id','course_id');
    }

    public function studentOfCourses()
    {
        return $this->belongsToMany('App\Course', 'course_student', 'student_id','course_id');
    }


    public function last_login_ago_str($full = false)
    {

        if ($this->last_login == null) {
            return "Never";
        }
        $datetime = $this->last_login;

        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public static $proPicDirPath = "uploads/profile-pics/";

    public static function defaultImage(){
        return url("assets/default-user.png");
    }

    public function getProPicUrlAttribute()
    {
        $value = $this->pro_pic;
        if(!$value){
           return self::defaultImage();
        }

        return url(self::$proPicDirPath.$value);
    }

}
