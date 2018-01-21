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
    foreach ($studentOfCourses as $key => $value) {
      # code...
    }   
  }
}
