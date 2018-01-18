<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function urlSlug(){
        return Helpers::slugit($this->title);
    }
}
