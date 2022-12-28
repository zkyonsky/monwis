<?php

namespace App\Customs;

use Illuminate\Support\Facades\DB;

class IkuCount {

    protected $trainer_id, $year, $kodeKK;


    public function __construct($trainer_id, $year)
    {
        $this->trainer_id = $trainer_id;
        $this->year = $year;
    }

    //menghitung total angka kredit setiap kegiatan
    public function angkre($kodeKK){
        $this->kodeKK = $kodeKK;
        $trainers = new \App\Trainer;
        $angkre = \App\Code::where('code', $kodeKK)->get()->pluck('credit')->first();
        $totAct = \App\Trainer::withCount(['activities', 
                                            'activities as code_count' => function ($query) {
                                                $query->where('code_id', $this->kodeKK);
                                                $query->where('status', 'Selesai');
                                                $query->where('deleted_by', null);
                                                $query->whereYear('end', $this->year) ;
                                            }])
                                ->where('id', $this->trainer_id)
                                ->get()->pluck('code_count')->first();
        
        $totAjar= \App\Trainer::withCount(['activities', 
                                            'activities as ajar_count' => function ($query) {
                                                $query->where('bahan_ajar', '1');
                                                $query->where('status', 'Selesai');
                                                $query->where('deleted_by', null);
                                                $query->whereYear('end', $this->year) ;
                                            }])
                                    ->where('id', $this->trainer_id)
                                    ->get()->pluck('ajar_count')->first();
        $totTayang= \App\Trainer::withCount(['activities', 
                                            'activities as tayang_count' => function ($query) {
                                                $query->where('bahan_tayang', '1');
                                                $query->where('status', 'Selesai');
                                                $query->where('deleted_by', null);
                                                $query->whereYear('end', $this->year) ;
                                            }])
                                    ->where('id', $this->trainer_id)
                                    ->get()->pluck('tayang_count')->first();
        $totSapGbpp=\App\Trainer::withCount(['activities', 
                                            'activities as sap_count' => function ($query) {
                                                $query->where('sap_gbpp', '1');
                                                $query->where('status', 'Selesai');
                                                $query->where('deleted_by', null);
                                                $query->whereYear('end', $this->year) ;
                                            }])
                                    ->where('id', $this->trainer_id)
                                    ->get()->pluck('sap_count')->first();
        
        $totJP = $trainers->getTatapmukaVolume($this->trainer_id, '118', $this->year);                               

        if($kodeKK == '118'){
            if ($trainers->getJabatan($this->trainer_id) == 'Widyaiswara Ahli Utama') {
                $totAngkre = ($totJP * 0.08) + ($totAjar* 0.6) + ($totTayang* 0.6) + ($totSapGbpp* 0.6);
            }elseif ($trainers->getJabatan($this->trainer_id) == 'Widyaiswara Ahli Madya') {
                $totAngkre = ($totJP * 0.06) + ($totAjar* 0.6) + ($totTayang* 0.6) + ($totSapGbpp* 0.6);
            }elseif ($trainers->getJabatan($this->trainer_id) == 'Widyaiswara Ahli Muda') {
                $totAngkre = ($totJP * 0.04) + ($totAjar* 0.6) + ($totTayang* 0.6) + ($totSapGbpp* 0.6);
            }else {
                $totAngkre = ($totJP * 0.02) + ($totAjar* 0.6) + ($totTayang* 0.6) + ($totSapGbpp* 0.6);
            }
        }else {
            
                $totAngkre = $totAct * $angkre;
            
        }

        return $totAngkre;
    }

    public function kodeKK(){
        $dikjartih = \App\Code::whereBetween('section_id', [2, 4])->get()->pluck('id')->toArray();

        $wi = \App\Trainer::with('activities')->findOrFail($this->trainer_id);

        $code = array();
        foreach ($wi->activities as $activity) {
           array_push($code, $activity->code_id);
        }

        $codeIntersect = array_intersect(array_unique($code), $dikjartih);

        return array_values($codeIntersect);
    }
}