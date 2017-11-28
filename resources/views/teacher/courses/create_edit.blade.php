@extends('teacher.layouts.base')
@section('section_name', 'Courses')

@section('content')
<div id="content-wrapper">
    <div class="mui--appbar-height"></div>
    <div class="mui-container-fluid">

        @if($course->exists)
            <h2>Edit Course</h2>
            {!! Form::model($course, ['method' => 'PATCH','route' => ['teacher.courses.update', $course->id]]) !!}
        @else
            <h2>Create Course</h2>
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

            <div class="mui-select">
            {!!
            Form::select('category_id',
            $categoriesList,
            null,
            ['placeholder' => 'Pick a category...'])
            !!}
                <label>Course Category</label>
            </div>

                <div class="mui--text-right">
                    <button type="submit" class="mui-btn mui-btn--raised mui-btn--primary">Save</button>
                </div>

        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection