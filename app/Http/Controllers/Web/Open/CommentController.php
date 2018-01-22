<?php

namespace App\Http\Controllers\Web\Open;

use App\Comment;
use App\Course;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\LiveStream;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index(Request $request){
        $user = Auth::user();

        $commentable = null;
        if($request->type == "lesson"){
            $commentable = Lesson::findOrFail($request->parent_id);
        }
        else if($request->type == "course"){
            $commentable = Course::findOrFail($request->parent_id);
        }
        else if($request->type == "reply"){
//            $reply = new Comment();
//            $reply->
//            $reply->makeChildOf($request->parentid);
//            $commentable = Comment::findOrFail($request->parent_id);

        }
        else if($request->type == "livestream"){
            $commentable = LiveStream::findOrFail($request->parent_id);
        }
        else {
            return;
        }

        $comments = $commentable->comments()->latest()->get();

        return view("open.comments.comment_view",compact("comments","user"));
    }

    public function store(Request $request){

        if(empty($request->comment)){
            return;
        }

        $commentable = null;
        $user = Auth::user();

        if($request->type == "lesson"){
            $commentable = Lesson::findOrFail($request->parent_id);
        }
        else if($request->type == "course"){
            $commentable = Course::findOrFail($request->parent_id);
            $user->comment($commentable, $request->comment,@$request->stars);
            return redirect()->back();
        }
        else if($request->type == "reply"){
            $reply = new Comment();
            $reply->comment = $request->comment;
            $reply->commentable_id = $request->parent_id;
            $reply->commentable_type = "App\Comment";
            $reply->commented_id = $user->id;
            $reply->commented_type = "App\User";
            $reply->approved = 1;
            $reply->rate = 0;

            $reply->save();

            return redirect()->back();

        }
        else if($request->type == "livestream"){
            $commentable = LiveStream::findOrFail($request->parent_id);
        }
        else {
            return;
        }

        $user->comment($commentable, $request->comment);

        return redirect()->back();

    }

    public function update(Request $request,$id){
        if(empty($request->comment)){
            return;
        }

        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;
        $comment->rate = @$request->stars;
        $comment->save();

        return redirect()->back();

    }

    public function create(Request $request){
        $type = $request->type;
        $parent_id = $request->parent_id;

        return view("open.comments.comment_edit",
            ['comment' => new Comment(),
                'user' => Auth::user(),
                "type" => $type,
                "parent_id" => $parent_id
            ]);

    }

    public function edit($id){
        $comment = Comment::findOrFail($id);

        return view("open.comments.comment_edit",
            ['comment' => $comment,
                'user' => Auth::user(),
            ]);
    }

}
