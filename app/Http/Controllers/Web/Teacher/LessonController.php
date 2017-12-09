<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Http\Controllers\Controller;
use App\Lesson;
use App\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $lesson = new Lesson();
        return view('teacher.lesson.create', compact('lesson', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());        
        $lesson = new Lesson();
        $videoId = null;
        $documentId = [];

        $file = $request->file('video');
        if($file){
            $videoId = $this->uploadFiles($file);
        }

        $file = $request->file('document');        
        if($file){
            foreach ($file as $key => $value) {
              array_push($documentId, $this->uploadFiles($value));  
          }
      }
      
      $lesson->course_id = $request->get('id');        
      $lesson->short_description = $request->get('short_description');        
      $lesson->video_file_id = $videoId;        
      $lesson->lesson_text = $request->get('lesson_text');        
      $lesson->json_file_ids = json_encode($documentId);
      $lesson->save();      
      
      return redirect('/teacher/courses/'.$request->get('id'));      
  }


  public function uploadFiles($file){
    
    $extension = $file->getClientOriginalExtension();
    $video = time().rand().'.'.$extension;
    $destinationPath = public_path('/uploads');
    $file->move($destinationPath, $video);  
    

    $uploadfile = new Uploads();
    
    $uploadfile->name = $file->getClientOriginalName();
    $uploadfile->size = $file->getClientSize();
    $uploadfile->path = $video;
    $uploadfile->uploader_id = Auth::user()->id;
    $uploadfile->save();

    return $uploadfile->id;
}



public function postSummernote(Request $request){
    $this->validate($request, [
    'image' => 'mimes:jpeg,png,jpg'
    ]);

    $extension = $request->file('image')->getClientOriginalExtension();
    $fileName =  time().rand().'.'.$extension;
    $destinationPath = public_path('/uploads');
    $request->file('image')->move($destinationPath, $fileName);    

    return $fileName;
}

public function ResourceUpload(Request $request){
    $document =  $request->file('document');
    $dummy = [];

    foreach ($document as $file) {
        $data = [];

        $extension = $file->getClientOriginalExtension();
        $fileName = time().rand().'.'.$extension;
        $destinationPath = public_path('/uploads');
        $file->move($destinationPath, $fileName);    

        $data['originalName'] = $file->getClientOriginalName();
        $data['name'] = $fileName;
        
        array_push($dummy, $data);
    }
    /*$dummy = array('data' => ['name' => $fileName]);*/
    return json_encode($dummy);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        // no way to tell if it is video or other file
            // so two separate calls are made...
        
        //$files = json_decode($lesson->json_file_ids);
        //array_push($files, $lesson->video_file_id);
        
        $documents = Uploads::findMany(json_decode($lesson->json_file_ids), ['id', 'name', 'path']);
        $videos = Uploads::findMany($lesson->video_file_id, ['id', 'name', 'path']);
        return view('teacher.lesson.lessons', compact('videos', 'documents', 'lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    { 
        return view('teacher.lesson.create', compact('lesson','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        /// only short_description and lesson text can be updated
        $lesson->short_description = $request->short_description;
        $lesson->lesson_text = $request->lesson_text;
        $lesson->save();
        return redirect('/teacher/lesson/'.$lesson->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
