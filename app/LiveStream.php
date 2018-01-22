<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{

    public function timeUntilString(){
        $now = new DateTime();
        $future_date = new DateTime($this->date_time);

        $interval = $future_date->diff($now);

        return $interval->format("%a days, %h hours, %i minutes Remaining...");
    }

    public function teacher(){
        return $this->belongsTo('App\User',"teacher_id");
    }

    public function urlSlug(){
        return Helpers::slugit($this->title);
    }
}
