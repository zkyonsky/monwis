<?php

namespace App\Http\Controllers;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class SpmkController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:spmks.index|spmks.edit|spmks.delete|spmks.show|spmks.download|spmks.upload']);
    }

    
    public function index()
    {
        $trainers = DB::table('trainers')
                                ->join('activity_trainer', 'trainers.id', '=', 'activity_trainer.trainer_id')
                                ->join('activities', 'activity_trainer.activity_id', '=', 'activities.id')
                                ->join('codes', 'activities.code_id', '=', 'codes.id')
                                ->where('trainers.unit', Auth::user()->unit)
                                ->whereNotNull('activities.code_id')
                                ->whereNotNull('codes.credit')
                                ->whereNull('activities.deleted_at')
                                ->whereYear('activities.end', Carbon::now()->format('Y'))
                                ->orderBy('activities.end', 'desc')
                                ->select(['trainers.full_name', 'activity_trainer.no_spmk', 'activity_trainer.no_stmk',
                                          'activity_trainer.id', 'activity_trainer.tgl_stmk',
                                          'activity_trainer.tgl_spmk','activities.event',
                                          'activities.batch','activities.class','activities.class',
                                          'activities.subject','activities.start','activities.end'])
                                ->get();
       
        return view('spmk.index', compact('trainers'));
    }

    public function edit($id)
    {
        $spmk = \App\ActivityTrainer::findOrFail($id);
        return response()->json($spmk);
    }

    public function update(Request $request){

        $spmk = \App\ActivityTrainer::findOrFail($request->id);

        $spmk->no_stmk = $request->no_stmk;
        $spmk->tgl_stmk = $request->tgl_stmk;
        $spmk->no_spmk = $request->no_spmk;
        $spmk->tgl_spmk = $request->tgl_spmk;
        $spmk->save();


        return redirect()->back();
    }

    public function show($id)
    {
        $jenisDokumen = \App\Document::all();
        $spmk = DB::table('trainers')
                                ->join('activity_trainer', 'trainers.id', '=', 'activity_trainer.trainer_id')
                                ->join('activities', 'activity_trainer.activity_id', '=', 'activities.id')
                                ->join('codes', 'activities.code_id', '=', 'codes.id')
                                ->where('activity_trainer.id', $id)
                                ->select(['trainers.full_name', 'activity_trainer.no_spmk', 'activity_trainer.no_stmk',
                                          'activity_trainer.id', 'activity_trainer.tgl_stmk',
                                          'activity_trainer.tgl_spmk','activities.id As activity_id','activities.event',
                                          'activities.batch','activities.class','activities.class',
                                          'activities.subject','activities.volume','activities.start','activities.end',
                                          'activities.place', 'codes.name', 'codes.code'])
                                ->first();
        // dd($spmk->activity_id);
        $activity = Activity::findOrFail($spmk->activity_id);
        // dd($activity);
        $file = $activity->documents()->get();
        // dd($file);
        return view('spmk.show', compact('spmk', 'jenisDokumen', 'file'));
    }

    public function download($id, $jenis)
    {
        $spmk = DB::table('trainers')
                                ->join('activity_trainer', 'trainers.id', '=', 'activity_trainer.trainer_id')
                                ->join('activities', 'activity_trainer.activity_id', '=', 'activities.id')
                                ->join('codes', 'activities.code_id', '=', 'codes.id')
                                ->join('sections', 'codes.section_id', '=', 'sections.id')
                                ->where('activity_trainer.id', $id)
                                ->select(['trainers.full_name', 'trainers.nip', 'trainers.panggol','trainers.jabatan', 'trainers.unit',
                                          'activity_trainer.no_stmk','activity_trainer.no_spmk', 'activity_trainer.id',
                                          'activity_trainer.tgl_stmk','activity_trainer.tgl_spmk','activities.event',
                                          'activities.batch','activities.class','activities.class',
                                          'activities.subject','activities.volume','activities.start','activities.end',
                                          'activities.place', 'codes.name AS jenis', 'codes.unit AS satuan',
                                          'codes.code', 'codes.credit', 'sections.name AS unsur'])
                                ->first();

        $credit = 0;
        $kk = 0;
        if($spmk->code == '118'){
            if($spmk->jabatan == 'Widyaiswara Ahli Utama'){
                $credit = 0.08;
                $kk = '14';
            }elseif($spmk->jabatan == 'Widyaiswara Ahli Madya'){
                $credit = 0.06;
                $kk = '13';
            }elseif($spmk->jabatan == 'Widyaiswara Ahli Muda'){
                $credit = 0.04;
                $kk = '12';
            }elseif($spmk->jabatan == 'Widyaiswara Ahli Pertama'){
                $credit = 0.02;
                $kk = '11';
            }
        }else{
            $credit = $spmk->code;
            $kk = $spmk->code;
        }

        $jumlah = $credit * $spmk->volume;

        $mp = null;
        if(isset($spmk->subject)){
            $mp = 'MP. '. $spmk->subject;
        }
        $angkatan = null;
        if(isset($spmk->batch)){
            $angkatan = 'Angkatan '. $spmk->batch;
        }

        $kelas = null;
        if(isset($spmk->class)){
            $kelas = 'Kelas '. $spmk->class;
        }

        $tglKegiatan = null;
        if($spmk->start == $spmk->end){
            $tglKegiatan = TanggalID('j M Y', $spmk->start);
        }elseif(Carbon::parse($spmk->start)->format('m Y') == Carbon::parse($spmk->end)->format('m Y')){
            $tglKegiatan = TanggalID('j', $spmk->start).' s.d '.TanggalID('j M Y', $spmk->end);
        }elseif(Carbon::parse($spmk->start)->format('Y') == Carbon::parse($spmk->end)->format('Y')){
            $tglKegiatan = TanggalID('j M', $spmk->start).' s.d '.TanggalID('j M Y', $spmk->end);
        }else{
            $tglKegiatan = TanggalID('j M Y', $spmk->start).' s.d '.TanggalID('j M Y', $spmk->end);
        }

        switch ($jenis) {
            case 'stmk':
                if($spmk->code == '118' && Auth::user()->unit == 'Pusdiklat Anggaran dan Perbendaharaan'){
                    $templateProcessor = new TemplateProcessor(asset('storage/STMK_Tamuk_AP.docx'));
                }elseif($spmk->code != '118' && Auth::user()->unit == 'Pusdiklat Anggaran dan Perbendaharaan'){
                    $templateProcessor = new TemplateProcessor(asset('storage/STMK_Nontamuk_AP.docx'));
                }elseif($spmk->code == '118' && Auth::user()->unit == 'Pusdiklat Pajak'){
                    $templateProcessor = new TemplateProcessor(asset('storage/STMK_Tamuk_Puspa.docx'));
                }elseif($spmk->code != '118' && Auth::user()->unit == 'Pusdiklat Pajak'){
                    $templateProcessor = new TemplateProcessor(asset('storage/STMK_Nontamuk_Puspa.docx'));
                }

                break;
            
            default:
            if($spmk->code == '118' && Auth::user()->unit == 'Pusdiklat Anggaran dan Perbendaharaan'){
                $templateProcessor = new TemplateProcessor(asset('storage/SPMK_Tamuk_AP.docx'));
            }elseif($spmk->code != '118' && Auth::user()->unit == 'Pusdiklat Anggaran dan Perbendaharaan'){
                $templateProcessor = new TemplateProcessor(asset('storage/SPMK_Nontamuk_AP.docx'));
            }elseif($spmk->code == '118' && Auth::user()->unit == 'Pusdiklat Pajak'){
                $templateProcessor = new TemplateProcessor(asset('storage/SPMK_Tamuk_Puspa.docx'));
            }elseif($spmk->code != '118' && Auth::user()->unit == 'Pusdiklat Pajak'){
                $templateProcessor = new TemplateProcessor(asset('storage/SPMK_Nontamuk_Puspa.docx'));
            }
                break;
        }    
     

        $templateProcessor->setValues([
            'nomor' => $spmk->no_spmk,
            'noStmk' => $spmk->no_stmk,
            'tahun' => Carbon::parse($spmk->end)->format('Y'),
            'nama' => $spmk->full_name,
            'nip' => $spmk->nip,
            'panggol' => $spmk->panggol,
            'jabatan' => $spmk->jabatan,
            'unit' => $spmk->unit,
            'upperUnsur' => strtoupper($spmk->unsur),
            'unsur' => $spmk->unsur,
            'jenis' => $spmk->jenis,
            'tglKegiatan' => $tglKegiatan,
            'volume' =>$spmk->volume,
            'mp' => $mp,
            'pelatihan' => $spmk->event,
            'angkatan' => $angkatan,
            'kelas' => $kelas,
            'tempat' => $spmk->place,
            'ak' => $credit,
            'kk' => $kk,
            'satuan' => $spmk->satuan,
            'jumlah' => $spmk->volume.' x '.$credit.' = '.$jumlah,
            'tglSpmk' => TanggalID('j M Y', $spmk->tgl_spmk),
            'tglStmk' => TanggalID('j M Y', $spmk->tgl_stmk),
        ]);

        $fileName = $spmk->full_name;

        switch ($jenis) {
            case 'stmk':
                header("Content-Disposition: attachment; filename=STMK " .$fileName. ".docx");
                break;
            
            default:
            header("Content-Disposition: attachment; filename=SPMK " .$fileName. ".docx");
                break;
        }
 
        $templateProcessor->saveAs('php://output');

        $pathToSave = asset('storage/save/spmk.docx');
        $templateProcessor->saveAs($pathToSave);
    }

    public function upload(Request $request)
    {
        
        $this->validate($request, [
            "jenis" => "required",
            "file" => "required|mimes:pdf",
        ]);

        $document = \App\Document::findOrFail($request->jenis);
        $activity = \App\Activity::findOrFail($request->activity_id);
        $subject = Str::limit($activity->subject, 20, '');
        $event = Str::limit($activity->event, 20, '');

        $tglKegiatan = null;
        if($activity->start == $activity->end){
            $tglKegiatan = Carbon::parse($activity->start)->format('d m Y');
        }elseif(Carbon::parse($activity->start)->format('m Y') == Carbon::parse($activity->end)->format('m Y')){
            $tglKegiatan = Carbon::parse($activity->start)->format('d').' s.d '.Carbon::parse($activity->end)->format('d m Y');
        }elseif(Carbon::parse($activity->start)->format('Y') == Carbon::parse($activity->end)->format('Y')){
            $tglKegiatan = Carbon::parse($activity->start)->format('d m').' s.d '.Carbon::parse($activity->end)->format('d m Y');
        }else{
            $tglKegiatan = Carbon::parse($activity->start)->format('d m Y').' s.d '.Carbon::parse($activity->end)->format('d m Y');
        }

        $fileName = $document->name."-".$subject."-".$event."-".$tglKegiatan.".pdf";

        if ($document->name == 'STMK') {

            $path = $request->file('file')->store('public/STMK');
        } else {

            $path = $request->file('file')->store('public/SPMK');
        }
        
        $activity->documents()->attach($document->id, ['file' => $path]);

        return redirect()->back();
    }
}
