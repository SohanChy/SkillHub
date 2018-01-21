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
    $categoryNavData = Cache::remember('categoryNavData', 15, function () {

      $categoryNavData = DB::table('categories')
      ->join('courses', 'categories.id', '=', 'courses.category_id')
      ->join('course_teacher', 'courses.id', '=', 'course_teacher.course_id')
      ->join('users', 'course_teacher.teacher_id', '=', 'users.id')
      ->select('courses.id as course_id','courses.title as course_title','courses.rating as course_rating',
      'categories.id as category_id', 'categories.name as category_name',
      'users.name as teacher_name','users.edu_stat as teacher_edu')
      ->get();

      return $categoryNavData->groupBy('category_id')->toArray();
    });
    
    /*dd($categoryNavData);*/

    View::share('categoryNavData', $categoryNavData);
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
