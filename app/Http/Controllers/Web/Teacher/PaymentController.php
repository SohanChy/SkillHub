<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Category;
use App\Course;
use App\Payment;
use App\Http\Controllers\Controller;
use App\StatusHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::where('teacher_id', '=', \Auth::id())
        ->where('finish_status', '=', '0')
        ->get();
        return view('teacher.payment.payment', compact('payments'));
    }


    public function payment(Request $request){  
        Payment::where('id', '=', \Auth::id())->update(['finish_status' => '1']);
        return redirect('/teacher'); 
    }
}
