<?php

namespace App\Http\Controllers\Web\Open;
use App\Course;
use App\User;
use App\CourseTeacher;
use App\Courses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function teacherProfile($id)
    {
        $user=User::find($id);
        $teacher_name=$user->name;

 /*
        //$courses=Courses::find($teacher->course_id);
        //echo $teacher->course_id;
        echo $user->name;

        $teacher=null;
        $all_teacher=CourseTeacher::whereIn('teacher_id',$id)->get();

        var_dump($all_teacher);
        foreach ($all_teacher as $m)
        {
            if($m->teacher_id==$id)
            {
                echo $m->teacher_id;
                $teacher=$m;
                break;
            }
        }

       echo $m->teacher_id;*/



       return view('open.teacher_profile',compact('teacher_name'));
    }
}
