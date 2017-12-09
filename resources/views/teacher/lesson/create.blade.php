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
                <div class="mui-col-md-2"><label id="imageUploadLabel">Upload a video: </label></div>
                <div class="mui-col-md-4">
                    <label class="mui-btn mui-btn--primary">
                        Browse files
                        <input type="file" name="video" hidden>
                    </label>
                </div>
            </div>

            
            <label>Add an article: </label>
            <div class="mui-textfield mui-textfield--float-label">
                {!! Form::textarea('lesson_text',null,['id' => 'summernote' ]) !!}
            </div>
            

            <div class="mui-row">
                <div class="mui-col-md-2"><label id="imageUploadLabel">Upload a document: </label></div>
                <div class="mui-col-md-4">
                    <label class="mui-btn mui-btn--primary">
                        Browse files
                        <input type="file" name="document[]" id="fileupload" data-url="{{URL::to('/teacher/uploadResource')}}" multiple hidden>
                    </label>
                </div>
            </div>

            <div id="progress">
                <div class="bar" style="margin-top: 10px;margin-bottom: 10px;width: 0%; height: 18px; background:green;"></div>
            </div>

            <div id="uploadStat"></div>

            <div id="uploadedResources"></div>

            @if(!$lesson->exists)
            <input type="hidden" name="id" value="{{$id}}">
            @endif            


            <div class="mui--text-right">
                <button type="submit" class="mui-btn mui-btn--raised mui-btn--primary">Save</button>
            </div>

        </div>

    </div>    
</div>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('js/jquery.fileupload.js') }}"></script>


<script type="text/javascript">
  $(document).ready(function() {
    var flag = true;
    var fileNames = [];
    
    $('#summernote').summernote({
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

    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            if(flag){
                $('<label/><br/>').text("Already Uplaoded materials:").appendTo("#uploadStat");
                flag = false;
            }            
            fileNames.push(data.result[0].name);
            console.log(fileNames);
            $('<label/><br/>').text(data.result[0].originalName).appendTo("#uploadedResources");
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
            'width',
            progress + '%'
            );
        }
    });

    function sendFile(file, url, editor) {
        data = new FormData();
        data.append("image", file);
        data.append("_token",'{{ csrf_token() }}');
        $.ajax({
            data: data,
            type: "POST",
            url: "{{URL::to('/teacher/summernote')}}",
            cache: false,
            contentType: false,
            processData: false,
            success: function(responseText) {
                var imgUrl = '{{URL::to('uploads')}}'+'/'+responseText;
                editor.summernote('insertImage', imgUrl);
            }
        });
    }
});
</script>



@endsection