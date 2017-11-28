<?php

namespace App\Http\Controllers\Web\Admin;
use App\Course;
use App\Http\Controllers\Controller;
use App\StatusHelper;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
	
	public function index(){

	    //Dont show drafts, only published
        $courses = Course::where("publish_status", StatusHelper::getStatusKey("Published",Course::$publishStatusArr));

        //Future when filters are implemented
        //$courses = $courses->where("admin_status", StatusHelper::getStatusKey("Pending",Course::$adminStatusArr));

        $courses = $courses->get();
        return view('admin.courses', compact('courses'));
	}

	public function show($id){
		$course = Course::find($id);
		$decisionList = Course::$adminStatusArr;
		return view('admin.approve_course', compact('course', "decisionList"));
	}

	public function update(Request $request ,$id){

		$course = Course::find($id);		
		$course->admin_status = $request->admin_status;
		$course->save();

		return redirect('/admin/approval');
	}	
}
