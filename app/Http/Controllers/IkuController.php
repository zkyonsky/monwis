<?php

namespace App\Http\Controllers;

use App\Iku;
use App\User;
use App\Trainer;
use Carbon\Carbon;
use App\Customs\IkuCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class IkuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:ikus.index|ikus.detail|ikus.target|ikus.edit|ikus.delete']);
    }

    public function index()
    {
        $trainers = \App\Trainer::with('activities');
        $user = User::findOrFail(Auth()->user()->id);

        if ($user->hasRole('wi')) {
            $wis = $trainers->where('status', 'Widyaiswara')
                        ->where('full_name', Auth::user()->name)
                        ->get();
        } else {
            $wis = $trainers->where('status', 'Widyaiswara')
                        ->where('unit', Auth::user()->unit)
                        ->get();
        }
        
        
        $iku = new Iku();     
        $tot = array();
        try {
            foreach ($wis as $wi) {
                $year = Carbon::now()->format('Y');
                $ikuCount = new IkuCount($wi->id, $year);
                $code = new \App\Code;
                $kodeKegiatan = $ikuCount->kodeKK();
               
                $angkre['id'] = $wi->id;
                $angkre['wi'] = $wi->full_name;
                
                $ak = 0;
                $len = count($kodeKegiatan);
                for ($i=0; $i < $len; $i++) { 
                    $ak = $ak + $ikuCount->angkre($kodeKegiatan[$i]);
                }
    
                $angkre['total'] = $ak;
                $angkre['target'] = $iku->getTarget($wi->id);
                $angkre['capaian'] = ($ak / $iku->getTarget($wi->id)*100);
                
                
                \App\Iku::where('trainer_id', $wi->id)->where('tahun', $year)->update(['realisasi' => $ak]);
    
                array_push($tot, $angkre);
                $angkre = array();
            }
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with(['error' => 'Input Target IKU Dulu!']);
        }
       

        return view('ikus.index', compact('tot'));
        
    }

    public function create()
    {
        $wis = Trainer::where('unit', Auth::user()->unit)->get();
        return view('ikus.create', compact('wis'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'trainer_id' => 'required',
            'tahun' => 'required',
            'target' => 'required',
        ]);

        $iku = Iku::create([
            'trainer_id' => $request->input('trainer_id'),
            'tahun' => $request->input('tahun'),
            'target' => $request->input('target'),
        ]);


        if($iku){
            //redirect dengan pesan sukses
            return redirect()->route('iku.target')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('iku.target')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        $iku = \App\Iku::findOrFail($id);
        return response()->json($iku);
    }

    public function update(Request $request){

        $iku = \App\Iku::findOrFail($request->id);
        $iku->tahun = $request->tahun;
        $iku->target = $request->target;
        $iku->save();


        return redirect()->back();
    }

    public function detail(Request $request)
    {
        
        $wis = \App\Trainer::findOrFail($request->id);
        $year = Carbon::now()->format('Y');
        $ikuCount = new IkuCount($request->id, $year);
        $code = new \App\Code;
        $kodeKegiatan = $ikuCount->kodeKK();


        $activities = array();
        foreach($kodeKegiatan as $kk){
            $activities[$code->getName($kk)] = $ikuCount->angkre($kk);

        }

        return view('ikus.detail', compact('activities', 'wis'));
    }

    public function target()
    {
        $wis = Trainer::where('unit', Auth::user()->unit)->get('id')->toArray();
        $ikus = Iku::whereIn('trainer_id', $wis)->get();

        $wi = new Trainer();
        
        return view('ikus.target', compact('ikus', 'wi'));

    }

    public function destroy($id)
    {
        $iku = \App\Iku::findOrFail($id);
        $iku->delete();

        Alert::success('Iku Berhasil Dihapus');
        return redirect()->back();
    }
}
