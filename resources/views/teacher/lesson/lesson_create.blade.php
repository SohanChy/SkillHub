@extends('teacher.layouts.base')
@section('section_name', 'Lessons')

@section('content')
<div id="content-wrapper">
    <div class="mui--appbar-height"></div>
    <div class="mui-container-fluid">

        @if($lesson->exists)
        <h2>Edit Lesson</h2>
        {!! Form::model($lesson, ['method'=>'PATCH','route' => ['teacher.lesson.update', $lesson->id], 'files' => true ]) !!}
        @else
        <h2>Create a Lesson</h2>
        {!! Form::model($lesson, ['route' => ['teacher.lesson.store'],  'files' => true]) !!}
        @endif

        <div class="mui-panel">
            @component('mui.errors',
            ['errors' => $errors])
            @endcomponent


            @component('mui.textfield',
            ['name' => 'short_description', 'type' => 'textarea'])
            @endcomponent
            
            <div class="mui-row">
                <div class="mui-col-md-2"><label>Upload a video: </label></div>
                <div class="mui-col-md-4">{!! Form::file('video') !!}</div>
            </div>

            @component('mui.textfield',
            ['name' => 'write_an_article', 'type' => 'textarea'])
            @endcomponent
            

            <div class="mui-row">
                <div class="mui-col-md-3"><label>Upload a document: </label></div>
                <div class="mui-col-md-4">{!! Form::file('document') !!}</div>
            </div>
            
            <input type="hidden" name="id" value="{{$id}}">
            <div class="mui--text-right">
                <button type="submit" class="mui-btn mui-btn--raised mui-btn--primary">Save</button>
            </div>

        </div>

    </div>
</div>
@endsection