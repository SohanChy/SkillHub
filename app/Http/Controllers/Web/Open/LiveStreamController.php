<?php

namespace App\Http\Controllers\Web\Open;

use App\Course;
use App\LiveStream;
use App\Uploads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiveStreamController extends Controller
{

  public function __construct()
  {
      HomeController::courseNavDataShare();
  }

    public function streamNow($id){
        $stream = LiveStream::findOrFail($id);

        $userId = Auth::id();
        $subscribedStatus = in_array($userId,json_decode($stream->students_json));

        $isTeacher = false;
        if($stream->teacher_id == $userId){
            $isTeacher = true;
        }

        if($isTeacher){
            $subscribedStatus = true;
        }

        return view("open.stream_now",
            compact("stream","subscribedStatus","isTeacher"));

  }


  public function enrollStudent(Request $request){
    DB::table('course_student')->insert(
    ['student_id' => \Auth::id(), 'course_id' => $request->get('id'), 'payment_code' =>$request->get('transaction_code')]
    );
    return redirect()->route('course', $request->get('id'));
  }

  public function liveStreams(){

        $streams = LiveStream::with('teacher')->get();
        return view("open.livestreams",compact('streams'));
  }


  public function checkout($id){
    $stream = LiveStream::findOrFail($id);
    $userId = Auth::id();

    $subscribedStatus = in_array($userId,json_decode($stream->students_json));

    if($subscribedStatus == false){
      return view('open.checkout.stream_checkout', compact('stream'));
    } else {
      return redirect()->back();
    }
  }

  public function checkoutDone(Request $request,$id){

      $stream = LiveStream::findOrFail($id);


      //Do Payment Processing here using Merchant API
      //$request->transaction_code


      $StuJson = json_decode($stream->students_json);
      $StuJson[] = Auth::id();
      $stream->students_json= json_encode(array_unique($StuJson));

      $stream->save();

      return redirect("stream-now/".$stream->id);
  }

}
