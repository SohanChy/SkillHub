@extends('teacher.layouts.base')
@section('section_name', 'Course')

@section('content')
<div id="content-wrapper">
    <div class="mui--appbar-height"></div>
    <div class="mui-container">
        <div class="mui-container">
            
            <div class="mui-panel">
              <div class="mui-row" >
                 
                <div class="mui--text-display1" id="course_detail">{{ $course->title }}</div>
                <div class="mui--text-body2" id="course_detail">{{ $course->small_description }}</div>
                
                <br/>

                <div class="mui-row">                
                    @if(!$lessons->isEmpty())
                    <div class="mui-col-md-8"><div class="mui--text-headline" id="course_detail">Lessons added: </div></div>
                    @else
                    <div class="mui-col-md-8"><div class="mui--text-headline" id="course_detail">No lesson added. Click Add new lesson to add one.</div></div>
                    @endif
                    
                    <div class="mui-col-md-4" id="lesson_add"><a class="mui-btn mui-btn--raised mui-btn--primary mui--pull-right" href="{{URL::to('/teacher/lesson/create/'.$course->id)}}">Add new lesson</a></div>
                    
                </div>

                
            </div>
        </div>
    </div>

    @foreach($lessons as $lesson)
    @component("teacher.lesson.lesson_card",['lesson' => $lesson])
    @endcomponent
    @endforeach

    <br>
    <br>
    
</div>
</div>
@endsection