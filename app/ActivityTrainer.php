<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTrainer extends Model
{
    protected $table = 'activity_trainer';

    protected $guarded = [];

    public function activity(){
    	return $this->belongsTo('App\Activity');
    }

    public function trainer(){
    	return $this->belongsTo('App\Trainer');
    }
}
