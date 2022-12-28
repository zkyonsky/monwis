<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = ['code_id', 'event', 'batch', 'class', 
                            'subject', 'volume', 'place', 'start',
                            'end', 'status', 'created_by', 'bahan_ajar', 'bahan_tayang',
                            'sap_gbpp',                
    ];


    public function code(){
        return $this->belongsTo('App\Code');
    }                      
    public function trainers(){
        return $this->belongsToMany('App\Trainer')->withPivot('no_spmk', 'tgl_spmk', 'no_stmk', 'tgl_stmk');;
    }

    public function documents(){
        return $this->belongsToMany('App\Document')->withPivot('file');
    }

    public function getTotal($date){
        return $this->whereDate('start', '<=', $date)
                    ->whereDate('end', '>=', $date)
                    ->where('deleted_at', null)
                    ->count();
    }
}
