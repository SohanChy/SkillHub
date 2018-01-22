<?php

namespace App\Http\Controllers\Web\Student;

use App\Category;
use App\Course;
use App\Uploads;
use File;
use Response;

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


	public function getVideo($id){


		$uploads = Uploads::find($id);
		$file_path = $uploads->path;

		$path = storage_path().'\\app\\'.'/'.$file_path; 
		if(!File::exists($path)) abort(404); 
		$file = File::get($path);

		$type = File::mimeType($path);
		

		$response = Response::make($file, 200);
		$response->header('Content-Type', "video/mp4");
		return $response;
       //$fileContents = Storage::disk('local')->get("uploads/{$file_path}");

	}

}

