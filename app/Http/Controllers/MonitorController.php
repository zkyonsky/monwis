<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use DatePeriod;
use App\Trainer;
use App\Activity;
use DateInterval;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon as SupportCarbon;

class MonitorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:monitors.index|monitors.agenda|monitors.week']);
    }

    public function index(Request $request)
    {
        
        if(!empty($request->date)){
            $date = Carbon::parse($request->date)->toDateString();
        }else{
            $date = Carbon::now()->format('Y-m-d');
        }
        
        $WI = new \App\Customs\Widyaiswara;
        $availableWI = $WI->available($date, Auth::user()->unit);

        return view('monitors.index', compact('availableWI', 'date'));
    }
    
    public function agenda(Request $request)
    {   
        $wis = new \App\Trainer;
        $user = User::findOrFail(Auth()->user()->id);


        try {
            if ($user->hasRole('wi')) {
                $trainer = \App\Trainer::where('unit', Auth::user()->unit)->first();
                $trainers = \App\Trainer::findOrFail($trainer->id)->activities()->get();
            }
            if(!empty($request->input('trainers'))){
                $trainers = \App\Trainer::findOrFail($request->input('trainers'))->activities()->get();
                $wi = $wis->getName($request->input('trainers'));
            }else{
                $trainer = \App\Trainer::where('unit', Auth::user()->unit)->first();
                $trainers = \App\Trainer::findOrFail($trainer->id)->activities()->get();
                $wi = $wis->getName($trainer->id);
            }
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with(['error' => 'Input pengajar terlebih dahulu!']);
        }
       

        $data = array();
        $calender = array();
        foreach($trainers as $activity){
            $data = array(
                'title' => $activity->event,
                'start' => $activity->start,
                'end'   => $activity->end,
            );
            array_push($calender, $data);
        }
        return view('monitors.agenda', compact('calender', 'wi'));
    }

    public function week(Request $request)
    {   
        $begin = null;
        $end = null;
        $period = null;
        $trainers = null;
        $activities = null;
        $head = array('Nama');
        $headLength = null;
        $rowLength = null;
        $dataLength = null;
        $reqStart = substr($request->daterange,0,10);
        $reqEnd = substr($request->daterange,13);        
        $row = array();

        if(!empty($request->daterange)){
            $begin = new DateTime($reqStart);
            $end = new DateTime($reqEnd);
            $end->modify('+1 day');

            $interval = DateInterval::createFromDateString('1 day');

            $period = new DatePeriod($begin, $interval, $end);
           
            $trainers = \App\Trainer::with('activities')->where('unit', Auth::user()->unit)->get();
            $wi = new Trainer();

            foreach ($period as $dt) {
            array_push($head, TanggalID('l, j M Y', Carbon::parse($dt)->format('l, d-M-Y')));
            }
            
            
            try {
                foreach ($trainers as $trainer) { 
                    $wi = Trainer::find($trainer->id);
                    $data = array(); 
                    $wi_name = array();
    
                    foreach ($period as $dt) {
                        array_push($data, $wi->getActivityDate($trainer->id, Carbon::parse($dt)->format('Y-m-d')));
                    } 
    
                    array_unshift($data, $wi->full_name);
                    array_push($row, $data);     
                }
                  
                $headLength = count($head);
                $rowLength = count($row);
                $dataLength = count($data);     
    
            } catch (\Throwable $th) {
                return redirect()->route('dashboard')->with(['error' => 'Input pengajar terlebih dahulu!']);
            }
            
        }
            return view('monitors.week', compact('begin', 'end', 'period', 'head', 'headLength', 'row', 'rowLength', 'dataLength'));
        
        
    }
}
