@extends('teacher.layouts.base')
@section('section_name', 'Courses')

@section('content')
<div id="content-wrapper">
    <div class="mui--appbar-height"></div>
    <div class="mui-container-fluid">

        @if($course->exists)
            <h3>Edit Course</h3>
            {!! Form::model($course, ['method' => 'PATCH','route' => ['teacher.courses.update', $course->id]]) !!}
        @else
            <h3>Create Course</h3>
            {!! Form::model($course, ['route' => ['teacher.courses.store']]) !!}
        @endif

        <div class="mui-panel">
            @component('mui.errors',
                      ['errors' => $errors])
            @endcomponent

            @component('mui.textfield',
            ['name' => 'title'])
            @endcomponent

            @component('mui.textfield',
            ['name' => 'small_description', 'type' => 'textarea'])
            @endcomponent

            @component('mui.textfield',
            ['name' => 'full_description', 'type' => 'textarea','size'=>'30x7'])
            @endcomponent

            @component('mui.select',
            ['name' => 'category_id', 'list' => $categoriesList])
            @endcomponent

            @component('mui.select',
            ['name' => 'publish_status', 'list' => \App\Course::$publishStatusArr])
            @endcomponent

            @component('mui.submit')
            @endcomponent



        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection