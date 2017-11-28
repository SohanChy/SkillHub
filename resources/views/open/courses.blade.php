@extends('open.layouts.base')

@section('content')
    <div class="mui--text-center mui-container-fluid">


        @foreach($categories as $category)
            <div class="mui-row mui--text-center">

            <div class="mui--text-display3">{{$category->name}}</div>
            @foreach($category->courses as $course)
            @component("open.layouts.course_card",['course' => $course])
            @endcomponent

            @endforeach


            </div>
        @endforeach

    </div>
@endsection
