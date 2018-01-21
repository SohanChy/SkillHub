@extends('student.layouts.base')
@section('section_name', 'Courses')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
		<h3>Your Enrolled Courses</h3>
		@foreach($courses as $course)
		@component("mui.course_card_open",
		[
		'course' => $course,
		'colWidth' => 'mui-col-md-3'
		]
		)
		@endcomponent
		@endforeach
	</div>
</div>
@endsection