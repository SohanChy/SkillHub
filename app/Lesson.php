<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
	public function urlSlug(){
		return Helpers::slugit($this->title);
	}

	public function video()
	{
		return $this->hasOne('App\UploadedFile', 'id', 'video_file_id');
	}
}
