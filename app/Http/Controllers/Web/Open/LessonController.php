<?php

namespace App\Http\Controllers\Web\Open;

use App\Comment;
use App\Course;
use App\Http\Controllers\Controller;
use App\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{

    public function __construct()
    {
        HomeController::courseNavDataShare();
    }


    public function lessonPage($id, $lesson)
    {

        $course = Course::findOrFail($id);
        $userId = Auth::id();

        $subscribed = false;
        if (
            $course->students()->where('student_id', $userId)->count() >= 1
            ||
            $course->teachers()->where('teacher_id', $userId)->count() >= 1
        ) {
            $subscribed = true;
        }


        if ($subscribed) {
            $lesson = $course->lessons()->where('id', $lesson);

            if ($lesson->count() == 1) {
                $lesson = $lesson->first();
                $documents = Uploads::findMany(json_decode($lesson->json_file_ids), ['id', 'name', 'path']);

                session(['currentLessonUrl' => url()->current()]);

                $comments = $lesson->comments;
                $comment = new Comment();


                return view('open.lesson_description',
                    compact('lesson', 'course', 'documents','comments','comment'));
            }
            else {
                return view('error404');
            }
        } else {

            return redirect()->route('courses.checkout', $course->id);
        }
    }



  public function enrollStudent(Request $request){
    DB::table('course_student')->insert(
    ['student_id' => \Auth::id(), 'course_id' => $request->get('id'), 'payment_code' =>$request->get('transaction_code')]
    );

    $course = Course::find($request->get('id'));

    DB::table('payments')->insert(
    ['user_id' => \Auth::id(), 'course_id' => $request->get('id'), 'teacher_id' =>$course->teachers->first()->id, 'withdraw' => $course->price ]
    );

    return redirect()->route('course', $request->get('id'));
  }


    public function checkout($id)
    {
        $course = Course::findOrFail($id);
        $userId = \Auth::id();

        if ($course->students()->where('student_id', $userId)->count() == 0) {
            return view('open.checkout.course_checkout', compact('id', 'course'));
        } else {
            return redirect()->back();
        }
    }

}
