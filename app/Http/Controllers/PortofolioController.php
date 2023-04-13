<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index(){
        $portofolio = Portofolio::all();
        return view('pages.compro.portofolio.index', compact('portofolio'));
    }

    public function create(){
        return view('pages.compro.portofolio.create');
    }

    public function store(Request $request){
        $request->validate([
            'judul_portofolio' => 'required',
            'portofolio' => 'required',
        ]);

        $input_array_portofolio = array(
            'judul_portofolio' => $request['judul_portofolio'],
        );

        if($portofolio = $request->file('portofolio')){
            $destination_path = 'compro/portofolio/';
            $foto_portofolio = date('YmdHis') . "." . $portofolio->getClientOriginalExtension();
            $portofolio->move($destination_path, $foto_portofolio);
            $input_array_portofolio['portofolio'] = $foto_portofolio;
        }

        $portofolio = Portofolio::create($input_array_portofolio);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.portofolio.index')->with('success', 'Portofolio dengan judul '.$portofolio->judul_portofolio.' berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.portofolio.index')->with('success', 'Portofolio dengan judul '.$portofolio->judul_portofolio.' berhasil ditambahkan');
        }
    }

    public function show($id){
        $portofolio = Portofolio::find($id);
        return view('pages.compro.portofolio.show', compact('portofolio'));
    }

    public function edit($id){
        $portofolio = Portofolio::find($id);
        return view('pages.compro.portofolio.edit', compact('portofolio'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'judul_portofolio' => 'required',
        ]);

        $variable_portofolio = Portofolio::findOrFail($id);

        if($portofolio = $request->file('compro/portofolio')){
            $destination_path = 'portofolio/';
            $foto_portofolio = date('YmdHis') . "." . $portofolio->getClientOriginalExtension();
            $portofolio->move($destination_path, $foto_portofolio);
            $variable_portofolio['portofolio'] = $foto_portofolio;
        }

        $variable_portofolio->update([
            'judul_portofolio' => $request->judul_portofolio,
        ]);

        $portofolio = Portofolio::findOrFail($id);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.portofolio.index')->with('success', 'Berhasil melakukan perubahan pada portofolio dengan judul '.$portofolio->judul_portofolio);
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.portofolio.index')->with('success', 'Berhasil melakukan perubahan pada portofolio dengan judul '.$portofolio->judul_portofolio);
        }
    }

    public function destroy($id){
        $portofolio = Portofolio::find($id);
        
        $portofolio->update([
            'status_aktif' => 2,
        ]);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.portofolio.index')->with('fail', 'Portofolio dengan judul '.$portofolio->judul_portofolio.' berhasil dihapus');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.portofolio.index')->with('fail', 'Portofolio dengan judul '.$portofolio->judul_portofolio.' berhasil dihapus');
        }
    }
}
