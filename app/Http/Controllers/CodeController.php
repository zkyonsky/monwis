<?php

namespace App\Http\Controllers;

use App\Code;
use App\Section;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CodeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:codes.index|codes.create|codes.edit|codes.delete']);
    }

    public function index()
    {
        $codes = \App\Code::All();

        return view('codes.index', compact('codes'));
    }

    public function create()
    {
        $sections = Section::latest()->get();
        return view('codes.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'section' => 'required',
            'name' => 'required',
            'code' => 'required|unique:codes',
            'credit' => 'required',
            'unit' => 'required'
        ]);

        $code = Code::create([
            'section_id' => $request->input('section'),
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'credit' => $request->input('credit'),
            'unit' => $request->input('unit')
        ]);


        if($code){
            //redirect dengan pesan sukses
            return redirect()->route('codes.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('codes.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Code $code)
    {
        $sections = Section::all();
        return view('codes.edit', compact('code','sections'));
    }

    public function update(Request $request, Code $code)
    {
        $this->validate($request, [
            'section' => 'required',
            'name' => 'required',
            'code' => 'required',
            'credit' => 'required',
            'unit' => 'required'
        ]);
        
        $kode = Code::findOrFail($code->id);
        $kode->update([
            'section_id' => $request->input('section'),
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'credit' => $request->input('credit'),
            'unit' => $request->input('unit')
        ]);

        if($kode){
            //redirect dengan pesan sukses
            return redirect()->route('codes.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('codes.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $code = \App\Code::findOrFail($id);
        $code->delete();

        Alert::success('Kode Berhasil Dihapus');
        return redirect()->back();
    }

    public function ajaxSearch(Request $request)
    {
        $search = $request->term;
        $data = \App\Code::where('name', 'LIKE', '%' .$search. '%')->get(['id', 'name as text']);
        return response()->json(['results' => $data]);
    }
}
