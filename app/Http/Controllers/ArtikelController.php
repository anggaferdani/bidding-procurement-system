<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Exports\ArtikelExport;
use App\Imports\ArtikelImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ArtikelController extends Controller
{
    public function export_artikel(){
        return Excel::download(new ArtikelExport, 'artikel.xlsx');
    }

    public function import_artikel(Request $request){
        $excel = $request->file('excel');
        $nama_file = $excel->getClientOriginalName();
        $excel->move('compro/excel', $nama_file);

        Excel::import(new ArtikelImport, public_path('/compro/excel/'.$nama_file));

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.artikel.index')->with('success', 'Berita berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.artikel.index')->with('success', 'Berita berhasil ditambahkan');
        }elseif(auth()->user()->level == 3){
            return redirect()->route('compro.creator.artikel.index')->with('success', 'Berita berhasil ditambahkan');
        }
    }

    public function cetak_pdf(){
        $artikel = Artikel::all();
        $isi_artikel = [
            'title' => 'Artikel',
            'date' => date('d/m/Y'),
            'artikel' => $artikel,
        ];

        $pdf = PDF::loadView('pages.compro.artikel.pdf', $isi_artikel);
        $pdf->set_paper("A4", "portrait");
        return $pdf->download('artikel.pdf');
    }

    public function index(){
        $artikel = Artikel::all();
        return view('pages.compro.artikel.index', compact('artikel'));
    }

    public function create(){
        return view('pages.compro.artikel.create');
    }

    public function store(Request $request){
        $request->validate([
            'judul_artikel' => 'required',
            'tanggal_published' => 'required',
            'thumbnail' => 'required',
            'isi_artikel' => 'required',
        ]);

        $input_array_artikel = array(
            'judul_artikel' => $request['judul_artikel'],
            'tanggal_published' => $request['tanggal_published'],
            'isi_artikel' => $request['isi_artikel'],
        );

        if($thumbnail = $request->file('thumbnail')){
            $destination_path = 'compro/thumbnail/';
            $foto_thumbnail = date('YmdHis') . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destination_path, $foto_thumbnail);
            $input_array_artikel['thumbnail'] = $foto_thumbnail;
        }

        $artikel = Artikel::create($input_array_artikel);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.artikel.index')->with('success', 'Artikel dengan judul '.$artikel->judul_artikel.' berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.artikel.index')->with('success', 'Artikel dengan judul '.$artikel->judul_artikel.' berhasil ditambahkan');
        }elseif(auth()->user()->level == 3){
            return redirect()->route('compro.creator.artikel.index')->with('success', 'Artikel dengan judul '.$artikel->judul_artikel.' berhasil ditambahkan');
        }
    }

    public function show($id){
        $artikel = Artikel::find($id);
        return view('pages.compro.artikel.show', compact('artikel'));
    }

    public function edit($id){
        $artikel = Artikel::find($id);
        return view('pages.compro.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'judul_artikel' => 'required',
            'tanggal_published' => 'required',
            'isi_artikel' => 'required',
        ]);

        $artikel = Artikel::findOrFail($id);

        if($thumbnail = $request->file('thumbnail')){
            $destination_path = 'compro/thumbnail/';
            $foto_thumbnail = date('YmdHis') . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destination_path, $foto_thumbnail);
            $artikel['thumbnail'] = $foto_thumbnail;
        }

        $artikel->update([
            'judul_artikel' => $request->judul_artikel,
            'tanggal_published' => $request->tanggal_published,
            'isi_artikel' => $request->isi_artikel,
        ]);

        $artikel = Artikel::findOrFail($id);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.artikel.index')->with('success', 'Berhasil melakukan perubahan pada artikel dengan judul '.$artikel->judul_artikel);
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.artikel.index')->with('success', 'Berhasil melakukan perubahan pada artikel dengan judul '.$artikel->judul_artikel);
        }elseif(auth()->user()->level == 3){
            return redirect()->route('compro.creator.artikel.index')->with('success', 'Berhasil melakukan perubahan pada artikel dengan judul '.$artikel->judul_artikel);
        }
    }

    public function destroy($id){
        $artikel = Artikel::find($id);
        
        $artikel->update([
            'status_aktif' => 2,
        ]);

        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.artikel.index')->with('fail', 'Artikel dengan judul '.$artikel->judul_artikel.' berhasil dihapus');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.artikel.index')->with('fail', 'Artikel dengan judul '.$artikel->judul_artikel.' berhasil dihapus');
        }elseif(auth()->user()->level == 3){
            return redirect()->route('compro.creator.artikel.index')->with('fail', 'Artikel dengan judul '.$artikel->judul_artikel.' berhasil dihapus');
        }
    }
}
