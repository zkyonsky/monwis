<?php

namespace App\Http\Controllers;

use App\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:trainers.index|trainers.create|trainers.edit|trainers.delete']);
    }

    public function index()
    {
        $trainers = \App\Trainer::where('unit', Auth::user()->unit)->orderBy('full_name')->get();

        return view('trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name'      => 'required',
            'nip'      => 'required',
            'unit'      => 'required',
            'panggol'      => 'required',
            'status'      => 'required',
        ]);

        if (is_null($request->input('jabatan_wi'))) {
            $jabatan = $request->input('jabatan_non_wi');
        } else {
            $jabatan = $request->input('jabatan_wi');
        }
        
       
        $trainer = Trainer::create([
            'full_name'      => $request->input('full_name'),
            'nip'     => $request->input('nip'),
            'unit'  => $request->input('unit'),
            'jabatan'  => $jabatan,
            'panggol'     => $request->input('panggol'),
            'status'     => $request->input('status')
        ]);
        

        if($trainer){
            //redirect dengan pesan sukses
            return redirect()->route('trainers.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('trainers.index')->with(['error' => 'Data Gagal Ditambahkan!']);
        }
    }

    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $this->validate($request, [
            'full_name'      => 'required',
            'nip'      => 'required',
            'unit'      => 'required',
            'panggol'      => 'required',
            'status'      => 'required'
        ]);

        $wi = Trainer::findOrFail($trainer->id);

        if (is_null($request->input('jabatan_wi'))) {
            $jabatan = $request->input('jabatan_non_wi');
        } else {
            $jabatan = $request->input('jabatan_wi');
        }
        
            $wi->full_name = $request->input('full_name');
            $wi->nip = $request->input('nip');
            $wi->unit = $request->input('unit');
            $wi->jabatan = $jabatan;
            $wi->panggol = $request->input('panggol');
            $wi->status = $request->input('status');
            $wi->save();

        if($wi){
            //redirect dengan pesan sukses
            return redirect()->route('trainers.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('trainers.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $trainer = \App\Trainer::findOrFail($id);
        $trainer->delete();

        Alert::success('Pengajar Berhasil Dihapus');
        return redirect()->back();
    }

    public function ajaxSearch(Request $request)
    {       
        $search = $request->term;
        $data = \App\Trainer::where('full_name', 'LIKE', '%' .$search. '%')->get(['id', 'full_name as text']);
        return response()->json(['results' => $data]);
    }
}
