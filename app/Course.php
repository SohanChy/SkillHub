<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Commentable;

class Course extends Model
{
    use Commentable;
    protected $canBeRated = true;
    protected $mustBeApproved = false;

    public function lessons()
    {
    	return $this->hasMany('App\Lesson')->orderBy('id', 'asc');
    }

    protected $guarded = ['rating'];

    public static $adminStatusArr = ["Pending", "Live", "Rejected"];
    public static $publishStatusArr = ["Draft", "Published"];


    public function teachers()
    {
        return $this->belongsToMany('App\User', 'course_teacher', 'course_id', 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany('App\User', 'course_student', 'course_id', 'student_id');
    }

    public function urlSlug(){
        return Helpers::slugit($this->title);
    }

    public static function makeUrl($id,$title){
        return url("courses/".$id."/".Helpers::slugit($title));
    }
}
