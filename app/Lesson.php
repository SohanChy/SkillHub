<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Commentable;

class Lesson extends Model
{
    Use Commentable;
    protected $mustBeApproved = false;

	public function urlSlug(){
		return Helpers::slugit($this->title);
	}

	public function video()
	{
		return $this->hasOne('App\UploadedFile', 'id', 'video_file_id');
	}
}
