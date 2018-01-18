@extends('teacher.layouts.base')

@section('styleHead')

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
@endsection

@section('section_name', 'Lessons')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
    <div class="mui-panel">

      @if($lesson->exists)
      <h2>Edit Lesson</h2>
      {!! Form::model($lesson, ['route' => ['teacher.lesson.update', $lesson->id], 'files' => true , 'id' => 'lessonform']) !!}
      @else
      <h2>Create a Lesson</h2>
      {!! Form::model($lesson, ['route' => ['teacher.lesson.store'],  'files' => true, 'id' => 'lessonform']) !!}
      @endif

      @component('mui.errors',
      ['errors' => $errors])
      @endcomponent
      
      @component('mui.textfield',
      ['name' => 'title'])
      @endcomponent

      @component('mui.textfield',
      ['name' => 'short_description', 'type' => 'textarea'])
      @endcomponent
      
      <div class="mui-row">
        <div class="mui-col-md-2"><label id="imageUploadLabel">Upload a video: </label></div>
        <div class="mui-col-md-4">
         <label class="mui-btn mui-btn--primary">
          Browse files
          <input id="videoupload" type="file" name="video" data-url="{{URL::to('/teacher/uploadVideo')}}" hidden>
        </label>
      </div>
    </div>

    <div id="videoProgress">
      <div class="videoProgressBar" style="margin-top: 10px;margin-bottom: 10px;width: 0%; height: 18px; background:green;"></div>
    </div>


    <div id="videoUploadStat">
      @if($videos)                
      <label id="videos_update">Already Uplaoded video</label><br/>
      @endif 
    </div>

    <div id="uploadedVideo">
      @if($videos)
      <label>{{$videos->name}}</label><br/>
      @endif 
    </div><br/>


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

  @if($uploads)
  <label id="uploaded_files_update">Already Uplaoded files</label><br/>
  @foreach($uploads as $upload)
  <label>{{$upload->name}}</label><br/>
  @endforeach
  @endif   

  <div id="uploadedResources"></div>

  @if(!$lesson->exists)
  <input type="hidden" name="id" id="check_edit_flag" value="{{$id}}">
  @endif 

  <div class="mui--text-right">
    <button type="submit" class="mui-btn mui-btn--raised mui-btn--primary">Save</button>
  </div>
</div>

</div>    
</div>

@endsection

@section('scriptsFoot')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>


<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('js/jquery.fileupload.js') }}"></script>


<script type="text/javascript">
	$(document).ready(function() {
	var flag = true;
  var video_flag = true;
  var fileNames = [];
  var video;

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

$('#videoupload').fileupload({
dataType: 'json',
maxFileSize: 500000000,
maxChunkSize: 10000000,
done: function (e, data) {
console.log(data);
if(video_flag && document.getElementById('uploaded_files_update') == null){
$('<label/><br/>').text("Uplaoded video:").appendTo("#videoUploadStat");
video_flag = false;
}
video = data.result.id;
$('#uploadedVideo').html('<label>'+data.result.name+'</label><br/>')
},
progressall: function (e, data) {
var progress = parseInt(data.loaded / data.total * 100, 10);
$('#videoProgress .videoProgressBar').css(
'width',
progress + '%'
);
}
});



$('#videoupload').bind('fileuploadfail', function (e, data) {
})



$('#fileupload').fileupload({
dataType: 'json',
done: function (e, data) {
console.log(data);

if(flag && document.getElementById('uploaded_files_update') == null){
$('<label/><br/>').text("Already Uplaoded materials:").appendTo("#uploadStat");
flag = false;
}
fileNames.push(data.result[0].id);
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



$('#lessonform').on('submit',function(e){
$.ajaxSetup({
header:$('meta[name="_token"]').attr('content')
})

e.preventDefault(e);
var files = {}; 
files['uploads'] = fileNames;
files['video'] = video;
console.log(files['video']);

if(document.getElementById('check_edit_flag') == null){
files['_method'] = 'PUT';
}
var formdata = $(this).serialize() +'&' + $.param(files);

$.ajax({

type:"POST",
url: $(this).attr('action'),
data: formdata,
dataType: 'json',
success: function(data){
console.log(data);
window.location.replace("http://localhost:8000/teacher/courses/"+data);
},
error: function(data){
console.log("Shit!");
}

})


});
});
</script>

@endsection


