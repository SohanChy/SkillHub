@extends('student.layouts.base')
@section('section_name', 'Courses')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
        <br />
        @if(session('currentLessonUrl', false))
        <div class="mui-panel">

            <div class="mui-row">
                <div class="mui--text-center mui--text-subhead">
                    Want to continue where you last left off?
                    <br/>
                    <a class="mui-btn mui-btn--small mui-btn--primary" href="{{url('student/courses/current')}}">
                        Yeah! Take me there.
                    </a>
                </div>

            </div>
        </div>
        @endif
        <div class="mui-panel">
		<h3>Your Enrolled Courses</h3>
		@foreach($courses as $course)

            @if($loop->first)
                <div class="mui-row">
            @elseif($loop->index % 4 == 0)
                </div>
                <div class="mui-row">
            @endif
		@component("mui.course_card_open",
		[
		'course' => $course,
		'colWidth' => 'mui-col-md-3'
		]
		)
		@endcomponent

             @if($loop->last)
                </div>
             @endif
		@endforeach

        </div>
	</div>
</div>
@endsection