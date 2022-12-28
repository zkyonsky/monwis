<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Iku extends Model
{
    protected $fillable = [
        'id', 'trainer_id', 'tahun', 'target', 'realisasi',
    ];

    public function trainer(){
        return $this->belongsTo('App\trainer');
    }

    public function getTarget($trainer_id){
        $year = Carbon::now()->format('Y');
        return $this->where('trainer_id', $trainer_id)->where('tahun', $year)->value('target');
    }

    public function getUnderPerformance($unit){
        return $this->join('trainers', 'trainers.id', '=', 'ikus.trainer_id')
                    ->where('trainers.unit', '=', $unit)
                    ->whereColumn('realisasi', '<', 'target')
                    ->get()
                    ->count();
    }
}
