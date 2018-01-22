<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table = 'payments';

	public function course()
	{
		return $this->hasOne('App\Course', 'id', 'course_id');
	}

	public function student()
	{
		return $this->hasOne('App\User', 'id', 'user_id');
	}
}
