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

    public static $statusArr = ["pending", "approved", "rejected","banned"];

    public static function getStatusString($status)
    {
        return self::$statusArr[(int)$status];
    }

    public static function getStatusKey($string)
    {
        if (is_numeric($string)) {
            return $string;
        }
        return array_search($string, self::$statusArr);
    }

    public static function getStatusAttribute($value)
    {
        return self::getStatusKey($value);
    }

    public function getMyStatusKey()
    {
        return self::$statusArr[(int)$this->status];
    }

    //Relations

    public static function index(Request $request)
    {
        $users = User::query();

        if ($request->has("status")) {
            $users = User::where('status', '=', $request->status);
        }

        if ($request->has("role")) {
            $users = $users->where("role", "=", $request->role);
        }

        if ($request->has("name")) {
            $users = $users->where("name", "LIKE", "%" . $request->name . "%");
        }

        $users = $users->orderByDesc("id")->paginate(25);

        return $users;
    }

    public static $proPicDirString = "uploads/profile_pics/";

    public static function proPicPath()
    {
        return public_path(self::$proPicDirString);
    }

    public function getProfilePictureAttribute()
    {
        if ($this->pro_pic != null) {
            return url(self::$proPicDirString . $this->pro_pic);
        } else return url("res/default_pro_pic.jpg");
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
}
