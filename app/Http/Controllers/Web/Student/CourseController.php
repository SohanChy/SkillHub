<?php

namespace App\Http\Controllers\Web\Student;

use App\Category;
use App\Course;
use App\Http\Controllers\Controller;
use App\StatusHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public function enrolled(Request $request)
    {
        $courses = Auth::user()->studentOfCourses()->latest()->get();
//        dd($courses);
        return view('student.courses.enrolled', compact('courses'));
    }

}
