<?php

namespace App\Http\Controllers;

use App\Models\JajaranDireksi;
use Illuminate\Http\Request;

class JajaranDireksiController extends Controller
{
    public function index(){
        $jajaran_direksi = JajaranDireksi::all();
        return view('pages.compro.jajaran-direksi.index', compact('jajaran_direksi'));
    }

    public function create(){
        return view('pages.compro.jajaran-direksi.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_panjang' => 'required',
            'jabatan' => 'required',
            'pendapat' => 'required',
        ]);

        $input_array_jajaran_direksi = array(
            'nama_panjang' => $request['nama_panjang'],
            'jabatan' => $request['jabatan'],
            'pendapat' => $request['pendapat'],
        );

        $jajaran_direksi = JajaranDireksi::create($input_array_jajaran_direksi);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.jajaran-direksi.index')->with('success', $jajaran_direksi->nama_panjang.' beserta pendapatnya berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.jajaran-direksi.index')->with('success', $jajaran_direksi->nama_panjang.' beserta pendapatnya berhasil ditambahkan');
        }
    }

    public function show($id){
        $jajaran_direksi = JajaranDireksi::find($id);
        return view('pages.compro.jajaran-direksi.show', compact('jajaran_direksi'));
    }

    public function edit($id){
        $jajaran_direksi = JajaranDireksi::find($id);
        return view('pages.compro.jajaran-direksi.edit', compact('jajaran_direksi'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_panjang' => 'required',
            'jabatan' => 'required',
            'pendapat' => 'required',
        ]);

        $jajaran_direksi = JajaranDireksi::find($id);
        
        $jajaran_direksi->update([
            'nama_panjang' => $request->nama_panjang,
            'jabatan' => $request->jabatan,
            'pendapat' => $request->pendapat,
        ]);
        
        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.jajaran-direksi.index')->with('success', $jajaran_direksi->nama_panjang.' beserta pendapatnya berhasil dilakukan perubahan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.jajaran-direksi.index')->with('success', $jajaran_direksi->nama_panjang.' beserta pendapatnya berhasil dilakukan perubahan');
        }
    }

    public function destroy($id){
        $jajaran_direksi = JajaranDireksi::find($id);
        
        $jajaran_direksi->update([
            'status_aktif' => 2,
        ]);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.jajaran-direksi.index')->with('fail', $jajaran_direksi->nama_panjang.' beserta pendapatnya berhasil dihapus');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.jajaran-direksi.index')->with('fail', $jajaran_direksi->nama_panjang.' beserta pendapatnya berhasil dihapus');
        }
    }
}
