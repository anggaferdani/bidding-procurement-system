<?php

namespace App\Http\Controllers;

use App\Models\JajaranKomisaris;
use Illuminate\Http\Request;

class JajaranKomisarisController extends Controller
{
    public function index(){
        $jajaran_komisaris = JajaranKomisaris::all();
        return view('pages.compro.jajaran-komisaris.index', compact('jajaran_komisaris'));
    }

    public function create(){
        return view('pages.compro.jajaran-komisaris.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_panjang' => 'required',
            'jabatan' => 'required',
            'pendapat' => 'required',
        ]);

        $input_array_jajaran_komisaris = array(
            'nama_panjang' => $request['nama_panjang'],
            'jabatan' => $request['jabatan'],
            'pendapat' => $request['pendapat'],
        );

        $jajaran_komisaris = JajaranKomisaris::create($input_array_jajaran_komisaris);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.jajaran-komisaris.index')->with('success', $jajaran_komisaris->nama_panjang.' beserta pendapatnya berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.jajaran-komisaris.index')->with('success', $jajaran_komisaris->nama_panjang.' beserta pendapatnya berhasil ditambahkan');
        }
    }

    public function show($id){
        $jajaran_komisaris = JajaranKomisaris::find($id);
        return view('pages.compro.jajaran-komisaris.show', compact('jajaran_komisaris'));
    }

    public function edit($id){
        $jajaran_komisaris = JajaranKomisaris::find($id);
        return view('pages.compro.jajaran-komisaris.edit', compact('jajaran_komisaris'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_panjang' => 'required',
            'jabatan' => 'required',
            'pendapat' => 'required',
        ]);

        $jajaran_komisaris = JajaranKomisaris::find($id);
        
        $jajaran_komisaris->update([
            'nama_panjang' => $request->nama_panjang,
            'jabatan' => $request->jabatan,
            'pendapat' => $request->pendapat,
        ]);
        
        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.jajaran-komisaris.index')->with('success', $jajaran_komisaris->nama_panjang.' beserta pendapatnya berhasil dilakukan perubahan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.jajaran-komisaris.index')->with('success', $jajaran_komisaris->nama_panjang.' beserta pendapatnya berhasil dilakukan perubahan');
        }
    }

    public function destroy($id){
        $jajaran_komisaris = JajaranKomisaris::find($id);
        
        $jajaran_komisaris->update([
            'status_aktif' => 2,
        ]);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.jajaran-komisaris.index')->with('fail', $jajaran_komisaris->nama_panjang.' beserta pendapatnya berhasil dihapus');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.jajaran-komisaris.index')->with('fail', $jajaran_komisaris->nama_panjang.' beserta pendapatnya berhasil dihapus');
        }
    }
}
