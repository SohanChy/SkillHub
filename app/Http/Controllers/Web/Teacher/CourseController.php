<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Category;
use App\Course;
use App\Http\Controllers\Controller;
use App\StatusHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public static $validationRules = [
    'title' => 'required|max:191',
    'small_description' => 'required|min:30',
    'full_description' => 'required|min:30',
    'category_id' => 'required|exists:categories,id'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Auth::user()->teacherOfCourses()
        ->select("id","title","small_description","admin_status");

        $courses->when($request->has("publish_status"), function ($query) use ($request) {
            return
            $query->where('publish_status',
            StatusHelper::getStatusKey($request->publish_status,Course::$publishStatusArr)
            )->latest("courses.created_at");
        });

        $courses = $courses->get();

        \Debugbar::info($courses);

        return view("teacher.courses.index")->with(compact("courses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        $categoriesList = Category::pluck('name', 'id');
        return view("teacher.courses.create_edit")
        ->with( compact('course', 'categoriesList') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, self::$validationRules);
        $validatedData = $request->all();

        $course = Course::create($validatedData);

        $user = Auth::user();
        $course->teachers()->attach($user);

        if($course){
            return redirect()->route('teacher.courses.index');
        }
        else {
            return Redirect::back()->withErrors(['Error', 'Could not create course!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */

    public function show(Course $course)
    {
        $lessons = Course::find($course->id)->lessons;
        return view('teacher.courses.course_detail', compact('course','lessons'));
    }

    public function showStudents($id)
    {
        $course = Course::findOrFail($id);
        $students = $course->students;
        return view('teacher.courses.course_students', compact('course','students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        foreach ($course->teachers as $key) {
            if (Auth::user()->id == $key->pivot->teacher_id) {
                $categoriesList = Category::pluck('name', 'id');
                return view("teacher.courses.create_edit")
                ->with( compact('course', 'categoriesList') );
            }             
        }
        return redirect('/teacher/courses');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate($request, self::$validationRules);
        $validatedData = $request->all();

        $course->fill($validatedData);

        if($course->save()){
            return redirect()->route('teacher.courses.show',$course->id);
        }
        else {
            return Redirect::back()->withErrors(['Error', 'Could not save update!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
