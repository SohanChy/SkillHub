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
        return view('teacher.lesson.lesson_create', compact('lesson', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = new Lesson();
        
        $videoId = null;
        $documentId = [];

        $file = $request->file('video');
        if($file){
            $videoId = $this->uploadFiles($file);
        }

        $file = $request->file('document');        
        if($file){
            array_push($documentId, $this->uploadFiles($file));            
        }
        
        $lesson->course_id = $request->get('id');        
        $lesson->short_description = $request->get('short_description');        
        $lesson->video_file_id = $videoId;        
        $lesson->lesson_text = $request->get('write_an_article');        
        $lesson->json_file_ids = json_encode($documentId);
        $lesson->save();      
        
        return($lesson->all());
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return($lesson->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
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
        //
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
