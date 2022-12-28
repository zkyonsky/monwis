<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable=[
        'id', 'name', 'source_id',
    ];

    public function source(){
        return $this->belongsTo('App\Source');
    }

    public function codes(){
        return $this->hasMany('App\Code');
    }
}
