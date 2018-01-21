<?php

namespace App\Http\Controllers\Web\Open;

use App\Category;
use App\Course;
use App\Lesson;
use App\Uploads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{

  public function __construct()
  {
      HomeController::courseNavDataShare();
  }


  public function lessonPage($id, $lesson){

    $course = Course::findOrFail($id);
    $userId = \Auth::id();

    if($course->students()->where('student_id',$userId)->count() >= 1){
      $lesson = $course->lessons()->where('id', $lesson);

      if($lesson->count() == 1){
        $lesson = $lesson->first();
        $documents = Uploads::findMany(json_decode($lesson->json_file_ids), ['id', 'name', 'path']);
        return view('open.lesson_description', compact('lesson', 'course', 'documents'));
      } else {
        return view('error404');
      }
    } else {
      return redirect()->route('courses.checkout',$course->id);
    }
  }

  public function enrollStudent(Request $request){
    DB::table('course_student')->insert(
    ['student_id' => \Auth::id(), 'course_id' => $request->get('id'), 'payment_code' =>$request->get('bkash_token')]
    );
    return redirect()->route('course', $request->get('id'));
  }



  public function checkout($id){
    $course = Course::findOrFail($id);
    $userId = \Auth::id();

    if($course->students()->where('student_id',$userId)->count() == 0){
      return view('open.checkout', compact('id', 'course'));
    } else {
      return redirect('/');
    }
  }

}
