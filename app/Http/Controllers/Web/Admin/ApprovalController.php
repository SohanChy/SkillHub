<?php

namespace App\Http\Controllers\Web\Admin;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
	
	public function index(){
		$courses = Course::all();		
		return view('admin.courses', compact('courses'));
	}

	public function show($id){
		$course = Course::find($id);
		$dicisionList = ['pending', 'rejected', 'accepted']; 		
		return view('admin.approve_course', compact('course', 'dicisionList'));
	}

	public function update(Request $request ,$id){

		$course = Course::find($id);		
		$course->publish_status = $request->get('dicisionList');
		$course->save();

		return redirect('/admin/approval');
	}	
}
