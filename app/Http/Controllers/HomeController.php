<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use DatePeriod;
use App\Trainer;
use DateInterval;
use Carbon\Carbon;
use Nette\Utils\DateTime;
use App\Customs\Widyaiswara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $WI = new \App\Customs\Widyaiswara;
        $activities = new \App\Activity;
        $iku = new \App\Iku;
        $availableWI = $WI->available($today, Auth::user()->unit);
        $countAvailableWI = $WI->available($today, Auth::user()->unit)->count();
        $countWI = $WI->totWI(Auth::user()->unit);
        $countActivities = $activities->getTotal($today);
        $UnderPerformanceWI = $iku->getUnderPerformance(Auth::user()->unit);

        return view('dashboard', compact('availableWI', 'countAvailableWI', 'countWI', 'countActivities', 'UnderPerformanceWI'));
    }
    public function load()
    {
        $trainers = \App\Trainer::with('activities')->where('unit', Auth::user()->unit)->get();
        $data = array();
        $calender = array();
        foreach($trainers as $trainer){
            $name = $trainer->full_name;
            foreach($trainer->activities as $activity)
            {
                if (isset($activity->subject)) {
                    $data = array(
                        'title' => $name." - ".$activity->event." - MP. ".$activity->subject,
                        'start' => $activity->start,
                        'end'   => $activity->end,
                    );
                } else {
                    $data = array(
                        'title' => $name." - ".$activity->event,
                        'start' => $activity->start,
                        'end'   => $activity->end,
                    );
                }
                
                
                array_push($calender, $data);
            }
           
        }

       echo json_encode($calender);
    }

    
}
