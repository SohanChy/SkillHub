<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends \Actuallymab\LaravelComment\Models\Comment
{
    protected $mustBeApproved = false;


    public static function childComments($id){
        return Comment::where("commentable_type","App\Comment")
            ->where("commentable_id",$id)->get();
    }
}
