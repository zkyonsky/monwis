<?php

namespace App\Customs;

use Illuminate\Http\Request;

class Widyaiswara
{
    public function wi($unit){
        return \App\Trainer::where('status', 'Widyaiswara')
                ->where('unit', $unit)
                ->get();

    } 

    public function available($date, $unit)
    {
       

        $data = new \App\Trainer;
        $activities = $data->getActivities($date)->toArray();
        $widyaiswara = \App\Trainer::where('unit', $unit)->where('status', 'Widyaiswara')->whereNotIn('id', $activities)->get();
        
        return $widyaiswara;

    }

    public function totWI($unit){
        return $this->wi($unit)->count();
    }

}