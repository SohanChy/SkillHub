<?php

namespace App\Http\Controllers\Web\Open;

use App\Category;
use App\Course;
use App\Lessons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{

	public function __construct()
	{
		HomeController::courseNavDataShare();
	}


	public function coursePage($id){
		$course = Course::where("admin_status", '1')
		->where('id', $id)->first();
		if($course){
			return view("open.course_description", compact('course'));
		} else {
			return view('error404');
		}
	}
}
