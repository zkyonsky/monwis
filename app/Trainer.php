<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable=[
        'id', 'full_name', 'unit', 'status', 'nip', 'panggol', 'jabatan'
    ];

    public function ikus(){
        return $this->hasMany('App\Iku');
    }

    public function activities(){
        return $this->belongsToMany('App\Activity')->withPivot('no_spmk', 'tgl_spmk');
    }

    public function getName($id){
        return $this->where('id',$id)->value('full_name');
    }

    public function getId($name){
        return $this->where('full_name',$name)->value('id');
    }

    public function getJabatan($id){
        return $this->where('id',$id)->value('jabatan');
    }

    public function getActivities($date){
        return $this->join('activity_trainer', 'trainers.id', '=', 'activity_trainer.trainer_id')
                    ->join('activities', 'activity_trainer.activity_id', '=', 'activities.id')
                    ->Where(function($query) use($date) {
                        $query->whereDate('activities.start', '<=', $date);
                        $query->WhereDate('activities.end', '>=', $date);
                    })
                    ->select('trainers.id')
                    ->get();
   }

   public function getTatapmukaVolume($wi_id, $code, $year){
    return $this->join('activity_trainer', 'trainers.id', '=', 'activity_trainer.trainer_id')
                ->join('activities', 'activity_trainer.activity_id', '=', 'activities.id')
                ->where('trainers.id', $wi_id)
                ->where('activities.code_id', $code)
                ->whereYear('activities.end', '=', $year)
                ->where('activities.status', 'Selesai')
                ->where('activities.deleted_by', null)
                ->sum('activities.volume');
    }

    public function getExtraJp($wi_id, $code, $month, $year){
        return $this->join('activity_trainer', 'trainers.id', '=', 'activity_trainer.trainer_id')
                    ->join('activities', 'activity_trainer.activity_id', '=', 'activities.id')
                    ->where('trainers.id', $wi_id)
                    ->where('activities.code_id', $code)
                    ->whereYear('activities.end', '=', $year)
                    ->whereMonth('activities.end', '=', $month)
                    ->where('activities.status', 'selesai')
                    ->where('deleted_by', null)
                    ->select(
                            DB::raw('SUM(activities.volume) as sum_jp'), 
                            DB::raw('SUM(activities.bahan_ajar) as sum_ajar'), 
                            DB::raw('SUM(activities.bahan_tayang) as sum_tayang'), 
                            DB::raw('SUM(activities.sap_gbpp) as sum_sap'))
                    ->get()
                    ->toArray();
        }



    public function getActivityDate($wi_id, $date){
        return $this->join('activity_trainer', 'trainers.id', '=', 'activity_trainer.trainer_id')
                    ->join('activities', 'activity_trainer.activity_id', '=', 'activities.id')
                    ->where('trainers.id', $wi_id)
                    ->Where(function($query) use($date) {
                        $query->whereDate('activities.start', '<=', $date);
                        $query->WhereDate('activities.end', '>=', $date);
                    })
                    ->select(
                              \Illuminate\Support\Facades\DB::raw('CONCAT( activities.event, " ",COALESCE(activities.batch, " "), " ",COALESCE(activities.class, " ") ) AS  event'),
                              \Illuminate\Support\Facades\DB::raw('CONCAT( DATE_FORMAT(activities.start, "%H:%i"), " - ",DATE_FORMAT(activities.end, "%H:%i"), ".") AS  time'),)
                    ->get()
                    ->toArray();
    }

}
