<?php

namespace App\Http\Controllers\Web\Teacher;

use App\Category;
use App\Http\Controllers\Controller;
use App\LiveStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\Stream;

class LiveStreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $livestreams = Auth::user()->teacherOfStreams();

        $livestreams->when($request->has("finish_status"), function ($query) use ($request) {
            return
                $query->where('finish_status',
                    $request->finish_status
                )->latest();
        });

        $livestreams = $livestreams->get();

        \Debugbar::info($livestreams);

        return view("teacher.livestream.index")->with(compact("livestreams"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stream = new LiveStream();
        $stream->title = $request->title;
        $stream->date_time = $request->date_time;
        $stream->description = $request->description;
        $stream->finish_status = $request->finish_status;


        $stream->teacher_id = Auth::id();
        $stream->students_json = json_encode([]);


        $stream->save();
        return redirect("teacher/live-streams?finish_status=0");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }


    public function edit($id)
    {
        $stream = LiveStream::findOrFail($id);
        return view("teacher.livestream.create",compact("stream"));
    }

    public function create()
    {
        $stream = new LiveStream();
        return view("teacher.livestream.create",compact("stream"));
    }

    public function update(Request $request,$id)
    {
        $stream = LiveStream::findOrFail($id);
        $stream->title = $request->title;
        $stream->date_time = $request->date_time;
        $stream->description = $request->description;
        $stream->finish_status = $request->finish_status;

        $stream->save();
        return redirect("teacher/live-streams?finish_status=0");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
