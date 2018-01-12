<?php

namespace App\Http\Controllers\Web\Open;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
}
