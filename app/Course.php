<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['rating'];

    public static $adminStatusArr = ["pending", "live", "rejected"];
    public static $publishStatusArr = ["draft", "published"];


    public function teachers()
    {
        return $this->belongsToMany('App\User', 'course_teacher', 'course_id', 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany('App\User', 'course_student', 'course_id', 'student_id');
    }
}
