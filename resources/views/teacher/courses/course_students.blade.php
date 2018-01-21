@extends('teacher.layouts.base')
@section('section_name', 'Lessons')

@section('content')
<div id="content-wrapper">
    <div class="mui--appbar-height"></div>

    <div class="mui-container">
        <h3>Course: {{ $course->title }}</h3>
        <div class="mui-container">

            
            <div class="mui-panel">

                <div class="mui-row">
                    @if(!$students->isEmpty())
                        <div class="mui-col-md-8"><h4 id="course_detail"> {{count($students)}} Enrolled Students:</h4></div>
                    @else
                        <div class="mui-col-md-8"><h4 id="course_detail">No Students Yet</h4></div>
                    @endif
                </div>


                <div class="mui-panel">
                @foreach($students as $student)
                        <div class="mui-row">
                            <div class="mui-col-md-2">
                                <img style="width:50px;height: 50px;" src="{{$student->pro_pic}}">
                            </div>
                            <div class="mui-col-md-6">
                                <h4>{{$student->name}}</h4>
                            </div>
                            <div class="mui-col-md-2">
                                <h4>{{$student->email}}</h4>
                            </div>
                        </div>
                        <div class="mui-divider"></div>
                @endforeach
                </div>

            </div>
    </div>


    <br>
    <br>
    
</div>
</div>
@endsection