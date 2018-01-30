<?php

namespace App\Http\Controllers\Web\Open;

use App\Category;
use App\Comment;
use App\Course;
use App\Lesson;
use App\Lessons;
use App\Http\Controllers\Controller;
use App\Uploads;
use App\VideoStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{

	public function __construct()
	{
		HomeController::courseNavDataShare();
	}

    public function getVideo($id){

	    $courseVid = Course::findOrFail($id)->lessons()->first()->video_file_id;

        $uploads = Uploads::find($courseVid);
        $file_path = $uploads->path;

        $path = storage_path().'/app/'.$file_path;
        if(!File::exists($path)) abort(404);

//		$file = File::get($path);

//		$type = File::mimeType($path);


        /*$response = Response::make($file, 200);
        $response->header('Content-Type', "video/mp4");*/

        $stream = new VideoStream($path);
        return response()->stream(function() use ($stream) {
            $stream->start();
        });

//		return $response;
        //$fileContents = Storage::disk('local')->get("uploads/{$file_path}");

    }


  public function coursePage($id){
    $course = Course::where("admin_status", '1')
        ->where('id', $id)->first();

      $comments = $course->comments;
      $comment = new Comment();
      $comment->commentable_type = "App\Course";

      $subscribed = false;
      if(Auth::check()){
          $userId = Auth::id();
          if (
              $course->students()->where('student_id', $userId)->count() >= 1
              ||
              $course->teachers()->where('teacher_id', $userId)->count() >= 1
          ) {
              $subscribed = true;
          }
      }

      if($course){
          return view("open.course_description",
              compact('course','comments','comment','subscribed'));
      } else {
          return view('error404');
      }


  }
}
