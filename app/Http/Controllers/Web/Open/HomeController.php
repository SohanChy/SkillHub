<?php

namespace App\Http\Controllers\Web\Open;

use App\Category;
use App\Course;
use App\StatusHelper;
use App\Http\Controllers\Controller;
use App\LiveStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
//CODE TO SUBSCRIBE
/*
$StuJson = json_decode($stream->students_json);
$StuJson[] = Auth::id();
$stream->students_json= json_encode(array_unique($StuJson));
*/

public static function courseNavDataShare(){
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

        /*
        dd($categoryNavData);*/

        View::share('categoryNavData', $categoryNavData);
      }


      public function streamNow($id){
        $stream = LiveStream::findOrFail($id);

        $userId = Auth::id();
        $subscribedStatus = in_array($userId,json_decode($stream->students_json));

        $isTeacher = ($stream->teacher_id == $userId);

        if($isTeacher){
          $subscribedStatus = true;
        }

        return view("open.stream_now",
        compact("stream","subscribedStatus","isTeacher"));
      }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      HomeController::courseNavDataShare();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $courses = Course::all();

      $popularCourses = Course::where("admin_status", '1')->limit(5)->get();
      $topRatedCourses = Course::where("admin_status", '1')->orderByDesc("rating")->limit(5)->get();
      $trendingCourses = Course::where("admin_status", '1')->latest()->orderByDesc("rating")->limit(5)->get();
      $recentCourses = Course::where("admin_status", '1')->latest()->limit(5)->get();

      $frontPageContents = [
      "Most Popular Courses" => $popularCourses,
      "Top Rated Courses" => $topRatedCourses,
      "Trending Courses" => $trendingCourses,
      "Recently Added Courses" => $recentCourses
      ];

      return view('open.welcome',
      ["frontPageContents" => $frontPageContents]
      );
    }

    public function courseList(){

      $categories = \App\Category::with(['courses' => function ($query) {
        $query->where('admin_status', '1')->where('publish_status', '1');
      }])->get();
      return view("open.courses",compact('categories'));

    }

    public function liveStreams(){

      $streams = \App\LiveStream::with('teacher')->get();
      return view("open.livestreams",compact('streams'));
    }


    public function explore(Request $request){
      $course = Course::where('admin_status', '=', '1')->get();
      //return view('')
      /*if($request->category{
        ->where('cate')
      }*/


    }
  }
