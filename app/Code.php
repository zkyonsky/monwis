<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable=[
        'id', 'section_id', 'code', 'name', 'credit', 'unit',
    ];

    public function section(){
        return $this->belongsTo('App\Section');
    }

    public function activities(){
        return $this->hasMany('App\Activity');
    }

    public function getName($id){
        return $this->where('id',$id)->value('name');
    }

    public function getConversion($id){
        return $this->where('id',$id)->value('conversion');
    }
}
