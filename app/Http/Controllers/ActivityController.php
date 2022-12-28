<?php

namespace App\Http\Controllers;

use App\Code;
use App\User;
use DatePeriod;
use App\Trainer;
use App\Activity;
use DateInterval;
use Carbon\Carbon;
use Nette\Utils\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:inputs.index|inputs.create|inputs.edit|inputs.delete|inputs.show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = Carbon::now()->format('Y');  
        $user = User::findOrFail(Auth()->user()->id);
       
        if ($user->hasRole('wi')) {
            $activities = Activity::whereHas('trainers', function (Builder $query) {
                $query->where('trainers.full_name', Auth::user()->name);
            })->whereYear('end', $year)
            ->where('deleted_by', null)
            ->orderBy('end', 'desc')
            ->get();     
        } else {
            $activities = Activity::whereHas('trainers', function (Builder $query) {
                $query->where('unit', Auth::user()->unit);
            })->whereYear('end', $year)
            ->where('deleted_by', null)
            ->orderBy('end', 'desc')
            ->get();     
        }
                           
        $trainer = new \App\Trainer;
        return view('activities.index', compact('trainer','activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                
        $new_activity = new \App\Activity;

        // Kode KK Berdasarkan jenjang WI
        if($request->jenis_kegiatan == 'tamuk'){
            $new_activity->code_id = '118';
            $this->validate($request, [
                'event' => 'required',
                'trainers' => 'required',
                'volume' => 'required',
                'place' => 'required',
                'start' => 'required',
                'end' => 'required'
            ]);
        } else{
            $this->validate($request, [
                'code' => 'required',
                'event' => 'required',
                'trainers' => 'required',
                'volume' => 'required',
                'place' => 'required',
                'start' => 'required',
                'end' => 'required'
            ]);
            $new_activity->code_id =  $request->input('code');
        }
        $new_activity->event = $request->input('event');
        $new_activity->batch = $request->input('batch');
        $new_activity->class = $request->input('class');
        $new_activity->subject = $request->input('subject');
        if($request->input('bahan_ajar') == 'on'){
            $new_activity->bahan_ajar = '1';
        }else{
            $new_activity->bahan_ajar = '0';
        }
        if($request->input('bahan_tayang') == 'on'){
            $new_activity->bahan_tayang = '1';
        }else{
            $new_activity->bahan_tayang = '0';
        }
        if($request->input('sap_gbpp') == 'on'){
            $new_activity->sap_gbpp = '1';
        }else{
            $new_activity->sap_gbpp = '0';
        }
        $new_activity->volume = $request->input('volume');
        $new_activity->place = $request->input('place');
        $new_activity->start = Carbon::parse($request->input('start'))->toDateTimeString();
        $new_activity->end = Carbon::parse($request->input('end'))->toDateTimeString();
        $new_activity->status = $request->input('status');
        $new_activity->created_by = Auth::id();
        $new_activity->save();
        $new_activity->trainers()->attach($request->input('trainers'));

        Alert::success('Kegiatan Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function edit(Activity $activity)
    {
       
        $trainers = Trainer::whereRelation('activities', 'activities.id', $activity->id)->get();
        $code = Code::where('code', $activity->code_id)->first();
        $start = Carbon::parse($activity->start)->format('d-M-Y H:m');
        $end = Carbon::parse($activity->end)->format('d-M-Y H:m');
        return view('activities.edit', compact('activity', 'trainers', 'code', 'start', 'end'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $new_activity = Activity::findOrFail($activity->id);
        if($request->jenis_kegiatan == 'tamuk'){
            $new_activity->code_id = '118';
            $this->validate($request, [
                'event' => 'required',
                'trainers' => 'required',
                'volume' => 'required',
                'place' => 'required',
                'start' => 'required',
                'end' => 'required'
            ]);
        } else{
            $this->validate($request, [
                'code' => 'required',
                'event' => 'required',
                'trainers' => 'required',
                'volume' => 'required',
                'place' => 'required',
                'start' => 'required',
                'end' => 'required'
            ]);
            $new_activity->code_id =  $request->input('code');
        }
        
       

        $new_activity->event = $request->input('event');
        $new_activity->batch = $request->input('batch');
        $new_activity->class = $request->input('class');
        $new_activity->subject = $request->input('subject');
        if($request->input('bahan_ajar') == 'on'){
            $new_activity->bahan_ajar = '1';
        }else{
            $new_activity->bahan_ajar = '0';
        }
        if($request->input('bahan_tayang') == 'on'){
            $new_activity->bahan_tayang = '1';
        }else{
            $new_activity->bahan_tayang = '0';
        }
        if($request->input('sap_gbpp') == 'on'){
            $new_activity->sap_gbpp = '1';
        }else{
            $new_activity->sap_gbpp = '0';
        }
        $new_activity->volume = $request->input('volume');
        $new_activity->place = $request->input('place');
        $new_activity->start = Carbon::parse($request->input('start'))->toDateTimeString();
        $new_activity->end = Carbon::parse($request->input('end'))->toDateTimeString();
        $new_activity->status = $request->input('status');
        $new_activity->created_by = Auth::id();
        $new_activity->save();
        $new_activity->trainers()->sync($request->input('trainers'));

        if($new_activity){
            //redirect dengan pesan sukses
            return redirect()->route('activities.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('activities.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = \App\Activity::findOrFail($id);

        return view('activities.show', compact('activity'));
    }

     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = \App\Activity::findOrFail($id);
        $activity->delete();

        Alert::success('Kegiatan Berhasil Dihapus');
        return redirect()->back();
    }

       
}
