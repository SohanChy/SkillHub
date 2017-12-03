<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    public function lessons()
    {
    	return $this->hasMany('App\Lesson')->orderBy('id', 'asc');
    }

    protected $guarded = ['rating'];
}
