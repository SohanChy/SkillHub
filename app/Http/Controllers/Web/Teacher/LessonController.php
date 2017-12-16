<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Http\Controllers\Controller;
use App\Lesson;
use App\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;


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
     $uploads = [];
     $videos = [];
     return view('teacher.lesson.create', compact('lesson', 'id', 'uploads','videos'));
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $this->validate($request, [
        'short_description' => 'required',
        'video' => 'required',
        ]);
        
        $lesson = new Lesson();

        $lesson->course_id = $request->get('id');   
        $lesson->short_description = $request->get('short_description');        
        $lesson->video_file_id = $request->get('video');
        $lesson->lesson_text = $request->get('lesson_text');
        $lesson->json_file_ids = json_encode($request->get('uploads'));
        $lesson->save();      
        
        return $request->get('id');      
    }



    public function postSummernote(Request $request){
       $this->validate($request, [
       'image' => 'mimes:jpeg,png,jpg'
       ]);

       $extension = $request->file('image')->getClientOriginalExtension();
       $fileName =  time().rand().'.'.$extension;
       $destinationPath = public_path('/uploads');
       $request->file('image')->move($destinationPath, $fileName);    

       $uploadfile = new Uploads();
       
       $uploadfile->name = $file->getClientOriginalName();
       $uploadfile->size = $file->getClientSize();
       $uploadfile->path = $fileName;
       $uploadfile->uploader_id = Auth::user()->id;
       $uploadfile->save();

       return $fileName;
   }

   public function resourceUpload(Request $request){
    $this->validate($request, [
    'document' => 'max:10240'
    ]);

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
        
        $uploadfile = new Uploads();
        
        $uploadfile->name = $file->getClientOriginalName();
        $uploadfile->size = $file->getClientSize();
        $uploadfile->path = $fileName;
        $uploadfile->uploader_id = Auth::user()->id;
        $uploadfile->lesson_id = $request->get('lesson_id');
        $uploadfile->save();
        $data['id'] = $uploadfile->id;

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



 public function videoUpload(Request $request){
    $this->validate($request, [
    'video' => 'mimes:mp4'
    ]);

     // create the file receiver
    $receiver = new FileReceiver("video", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success
    if ($receiver->isUploaded()) {
            // receive the file
      $save = $receiver->receive();
            // check if the upload has finished (in chunk mode it will send smaller files)
      if ($save->isFinished()) {
                // save the file and return any response you need
       
       return $this->saveFile($save->getFile());
   } else {
                // we are in chunk mode, lets send the current progress
       /** @var AbstractHandler $handler */
       $handler = $save->handler();
       return response()->json([
       "done" => $handler->getPercentageDone(),
       ]);
   }
} else {
  throw new UploadMissingFileException();
}
}


protected function saveFile(UploadedFile $file)
{
 $fileName = $this->createFilename($file);
        // Group files by mime type
 $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
 $dateFolder = date("Y-m-W");
        // Build the file path
 $filePath = "upload/{$mime}/{$dateFolder}/";
 $finalPath = storage_path("app/".$filePath);
        // move the file name
 $file->move($finalPath, $fileName);
 
 $uploadfile = new Uploads();
 
 $uploadfile->name = $file->getClientOriginalName();
 $uploadfile->size = $file->getClientSize();
 $uploadfile->path = $filePath.$fileName;
 $uploadfile->uploader_id = Auth::user()->id;
 $uploadfile->save();     

 return response()->json([
 'name' => $file->getClientOriginalName(),
 'id' => $uploadfile->id 
 ]);
}
    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file)
    {
     $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension
        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;
        return $filename;
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    { 
     $file_ids = json_decode($lesson->json_file_ids);
     $uploads = Uploads::findMany($file_ids);
     $videos = Uploads::where('id', $lesson->video_file_id)->first();
     if(Auth::user()->id == $lesson->uploader_id){
         return view('teacher.lesson.create', compact('lesson','id','uploads','videos'));
     } else {
        return redirect('/teacher/courses');
    }
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
//        return $request->all();
        
        $lesson->short_description = $request->short_description;
        $lesson->lesson_text = $request->lesson_text;
        if($request->get('video')){
            $lesson->video_file_id = $request->get('video');
        }
        if($request->get('uploads')){
          $uploaded_files = json_decode($lesson->json_file_ids);
          $lesson->json_file_ids = json_encode(array_merge($uploaded_files,$request->get('uploads')));
      }
      $lesson->save();

      return $lesson->course_id;
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
