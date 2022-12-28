<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'id', 'name',
    ];

    public function sections(){
        return $this->hasMany('App\Section');
    }
}
