<?php

namespace App\Http\Controllers\Web\Open;

use App\Category;
use App\Comment;
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
    $course = Course::findOrFail($id);

      $comments = $course->comments;
      $comment = new Comment();

    return view("open.course_description",
        compact('course','comments','comment'));
  }
}
