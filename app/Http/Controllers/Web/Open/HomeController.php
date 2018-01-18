<?php

namespace App\Http\Controllers\Web\Open;

use App\Category;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

/*
    dd($categoryNavData);*/

        View::share('categoryNavData', $categoryNavData);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        $popularCourses = Course::inRandomOrder()->limit(5)->get();
        $topRatedCourses = Course::orderByDesc("rating")->limit(5)->get();
        $trendingCourses = Course::inRandomOrder()->limit(5)->get();
        $recentCourses = Course::latest()->limit(5)->get();

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
    public function coursePage($id){
            return view("open.course_description");
    }
}
