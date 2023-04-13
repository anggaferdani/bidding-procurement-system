<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengadaanYangBenar;

class PengadaanYangBenarController extends Controller
{
    public function index(){
        $pengadaan = PengadaanYangBenar::all();
        return view('pages.eproc.pengadaan-yang-benar.index', compact('pengadaan'));
    }

    public function create(){
        return view('pages.eproc.pengadaan-yang-benar.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_pengadaan' => 'required',
            'jenis_pengadaan' => 'required',
            'hps' => 'required',
            'tanggal_mulai_pengadaan' => 'required',
            'tanggal_akhir_pengadaan' => 'required',
        ]);

        $input_array_pengadaan = array(
            'nama_pengadaan' => $request['nama_pengadaan'],
            'jenis_pengadaan' => $request['jenis_pengadaan'],
            'hps' => $request['hps'],
            'tanggal_mulai_pengadaan' => $request['tanggal_mulai_pengadaan'],
            'tanggal_akhir_pengadaan' => $request['tanggal_akhir_pengadaan'],
        );

        $pengadaan = PengadaanYangBenar::create($input_array_pengadaan);

        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.pengadaan-yang-benar.index')->with('success', $pengadaan->nama_pengadaan.' beserta hpsnya berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.pengadaan-yang-benar.index')->with('success', $pengadaan->nama_pengadaan.' beserta hpsnya berhasil ditambahkan');
        }
    }

    public function show($id){
        $pengadaan = PengadaanYangBenar::find($id);
        return view('pages.eproc.pengadaan-yang-benar.show', compact('pengadaan'));
    }

    public function edit($id){
        $pengadaan = PengadaanYangBenar::find($id);
        return view('pages.eproc.pengadaan-yang-benar.edit', compact('pengadaan'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_pengadaan' => 'required',
            'jenis_pengadaan' => 'required',
            'hps' => 'required',
            'tanggal_mulai_pengadaan' => 'required',
            'tanggal_akhir_pengadaan' => 'required',
        ]);

        $pengadaan = PengadaanYangBenar::find($id);
        
        $pengadaan->update([
            'nama_pengadaan' => $request->nama_pengadaan,
            'jenis_pengadaan' => $request->jenis_pengadaan,
            'hps' => $request->hps,
            'tanggal_mulai_pengadaan' => $request->tanggal_mulai_pengadaan,
            'tanggal_akhir_pengadaan' => $request->tanggal_akhir_pengadaan,
        ]);
        
        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.pengadaan-yang-benar.index')->with('success', $pengadaan->nama_pengadaan.' beserta hpsnya berhasil dilakukan perubahan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.pengadaan-yang-benar.index')->with('success', $pengadaan->nama_pengadaan.' beserta hpsnya berhasil dilakukan perubahan');
        }
    }

    public function destroy($id){
        $pengadaan = PengadaanYangBenar::find($id);
        
        $pengadaan->update([
            'status_aktif' => 2,
        ]);

        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.pengadaan-yang-benar.index')->with('fail', $pengadaan->nama_pengadaan.' beserta hpsnya berhasil dihapus');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.pengadaan-yang-benar.index')->with('fail', $pengadaan->nama_pengadaan.' beserta hpsnya berhasil dihapus');
        }
    }
}
