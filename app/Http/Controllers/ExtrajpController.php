<?php

namespace App\Http\Controllers;

use App\Code;
use App\User;
use App\Trainer;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ExtrajpController extends Controller
{
    protected $month, $year;

    public function __construct()
    {
        $this->middleware(['permission:extrajps.index|extrajps.detail']);
    }

    public function index(Request $request){

        if(!empty($request->date)){
            $month = substr($request->date, 0, 2); 
            $year = substr($request->date, 3); 
            $monthName = $month;
        }else{
            $month = Carbon::now()->format('m'); 
            $year = Carbon::now()->format('Y');
            $monthName = Carbon::now()->format('M');   
        }
        $this->month = $month; 
        $this->year = $year; 
        $totJp = array();
        $user = User::findOrFail(Auth()->user()->id);
        $conversion_id = Code::whereNotNull('conversion')->get('id')->toArray();

        if ($user->hasRole('wi')) {
            $wis = \App\Trainer::where('status', 'Widyaiswara')
                    ->where('full_name', Auth::user()->name)
                    ->get();
        } else {
            $wis = \App\Trainer::where('status', 'Widyaiswara')
                    ->where('unit', Auth::user()->unit)
                    ->get();
        }

        $data = array();
        
        foreach ($wis as $wi) {
            $wi_tot = array();
            array_push($wi_tot, $wi->id);
            array_push($wi_tot, $wi->full_name);
            $wi_teachings = $wi->getExtraJp($wi->id, '118', $month, $year);
            foreach ($wi_teachings as $wi_teaching) {
                if (isset($wi_teaching['sum_jp'])) {
                    array_push($wi_tot, $wi_teaching['sum_jp']);
                } else {
                    array_push($wi_tot, 0);
                }

                if (isset($wi_teaching['sum_ajar'])) {
                    array_push($wi_tot, $wi_teaching['sum_ajar']);
                } else {
                    array_push($wi_tot, 0);
                }

                if (isset($wi_teaching['sum_tayang'])) {
                    array_push($wi_tot, $wi_teaching['sum_tayang']);
                } else {
                    array_push($wi_tot, 0);
                }

                if (isset($wi_teaching['sum_sap'])) {
                    array_push($wi_tot, $wi_teaching['sum_sap']);
                } else {
                    array_push($wi_tot, 0);
                }
                
            }

            for ($i=0; $i < count($conversion_id); $i++) { 
                $conversion_credit = Code::find($conversion_id[$i])->get('conversion');
                $wi_conversions = $wi->getExtraJp($wi->id, $conversion_id[$i], $month, $year);
                foreach ($wi_conversions as $wi_conversion) {
                    $conversion_per_id = $wi_conversion['sum_jp'] * $conversion_credit;
                }
                $conversion_tot = $conversion_per_id++;
            }
            array_push($wi_tot, $conversion_tot);
            array_push($data, $wi_tot);
        }

        

        return view('extrajp.index', compact('data', 'month', 'monthName', 'year'));
    }

    public function detail($id, $month, $year)
    {
        
        $wi = \App\Trainer::findOrFail($id);
        $activities = $wi->activities()
                      ->where('code_id', '118')
                      ->whereYear('end', $year)
                      ->whereMonth('end', $month)
                      ->where('status', 'selesai')
                      ->select('activities.code_id',
                               'activities.event', 
                               'activities.batch', 
                               'activities.class', 
                               'activities.volume', 
                               'activities.start', 
                               'activities.end', 
                               'activities.place',
                               'activities.bahan_ajar',
                               'activities.bahan_tayang',
                               'activities.sap_gbpp')
                      ->get();

        $result = array();
        $result_conversion = array();
        $sum_jp = 0;
        $sum_conversion = 0;
        foreach ($activities as $activity) {
           $paid = 0;
           $activity_arr = array();
                if ($sum_jp<=40 && $sum_jp + $activity->volume <= 40) {
                    $paid = 0;
                }
                if ($sum_jp <=40 && $sum_jp + $activity->volume > 40) {
                    $paid = $sum_jp + $activity->volume - 40;
                } 
                if ($sum_jp >=40) {
                    $paid = $activity->volume;
                } 
            $sum_jp = $sum_jp + $activity->volume;
           array_push( $activity_arr,
                [ 
                  'event' => $activity->event,           
                  'batch' => $activity->batch,           
                  'class' => $activity->class,          
                  'volume' => $activity->volume,           
                  'start' => $activity->start,           
                  'end' => $activity->end,           
                  'place' => $activity->place,           
                  'paid' => $paid,           
                ]
           );
           array_push($result, $activity_arr);
        }

        $activities_ajar = $activities->where('bahan_ajar', '=', 1)->toArray();
        foreach ($activities_ajar as &$ajar) {
            $ajar['code_id'] = '4';
        }
        $activities_tayang = $activities->where('bahan_tayang', '=', 1)->toArray();
        foreach ($activities_tayang as &$tayang) {
            $tayang['code_id'] = '5';
        }
        $activities_sap = $activities->where('sap_gbpp', '=', 1)->toArray();
        foreach ($activities_sap as &$sap) {
            $sap['code_id'] = '6';
        }
        $conversion_id = Code::whereNotNull('conversion')->get('id')->toArray();
        $activities_conversion = $wi->activities()
                      ->whereIn('code_id', $conversion_id)
                      ->whereYear('end', $year)
                      ->whereMonth('end', $month)
                      ->where('status', 'selesai')
                      ->select('activities.code_id',
                               'activities.event', 
                               'activities.batch', 
                               'activities.class',
                               'activities.start', 
                               'activities.end', 
                               'activities.place')
                      ->get()
                      ->toArray();

        $code = new Code();              

        $arr_conversion = array_merge($activities_ajar, $activities_tayang,  $activities_sap, $activities_conversion);
        foreach ($arr_conversion as $conversion) {
            $conversion_paid = 0;
            $code_name = $code->getName($conversion['code_id']);
            $code_conversion = $code->getConversion($conversion['code_id']);
            $conversion_arr = array();
                if ($sum_jp<=40 && $sum_jp + $code_conversion <= 40) {
                    $conversion_paid = 0;
                }
                if ($sum_jp <=40 && $sum_jp + $code_conversion > 40) {
                    $conversion_paid = $sum_jp +$code_conversion - 40;
                } 
                if ($sum_jp >=40) {
                    $conversion_paid = $code_conversion;
                } 
            $sum_conversion = $sum_conversion + $code_conversion;
            array_push( $conversion_arr,
                [ 
                    'name' => $code_name,
                    'event' => $conversion['event'],           
                    'batch' => $conversion['batch'],           
                    'class' => $conversion['class'],          
                    'volume' => $code_conversion,           
                    'start' => $conversion['start'],           
                    'end' => $conversion['end'],           
                    'place' => $conversion['place'],           
                    'paid' => $conversion_paid,           
                ]);

            array_push($result_conversion, $conversion_arr);
        }
        
        return view('extrajp.detail', compact('result', 'wi', 'month', 'year', 'sum_jp', 'result_conversion', 'sum_conversion'));
    }
}
