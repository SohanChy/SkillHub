@extends('teacher.layouts.base')
@section('section_name', 'Courses')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
		<h3>Your Courses</h3>
		@foreach($courses as $course)
		@component("teacher.courses.course_card",['course' => $course])
		@endcomponent
		@endforeach
	</div>
</div>
@endsection