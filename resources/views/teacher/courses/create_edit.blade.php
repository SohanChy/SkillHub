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

            <label>Full Description: </label>

            <div class="mui-textfield mui-textfield--float-label">
              {!! Form::textarea('full_description',null,['id' => 'full_description' ]) !!}
          </div>

          
          @component('mui.textfield',
          ['name' => 'price'])
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
@section('scriptsFoot')

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>


<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

<script>

    $(document).ready(function() {

    $('#full_description').summernote({
    height: 300,
    minHeight: null,
    maxHeight: null,
    callbacks: {
    onImageUpload: function(files) {
    url = $(this).data('upload');
    console.log(files);
    sendFile(files[0], url, $(this));
}
}
});
});
</script>

@endsection