<?php

namespace App\Http\Controllers\Eproc;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Exports\BeritaExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Imports\BeritaImport;
use Maatwebsite\Excel\Facades\Excel;

class BeritaController extends Controller
{
    public function export_berita(){
        return Excel::download(new BeritaExport, 'berita.xlsx');
    }

    public function import_berita(Request $request){
        $excel = $request->file('excel');
        $nama_file = $excel->getClientOriginalName();
        $excel->move('excel', $nama_file);

        Excel::import(new BeritaImport, public_path('/eproc/excel/'.$nama_file));

        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.berita.index')->with('success', 'Berita berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
        }
    }

    public function cetak_pdf(){
        $berita = Berita::all();
        $isi_berita = [
            'title' => 'Berita',
            'date' => date('d/m/Y'),
            'berita' => $berita,
        ];

        $pdf = PDF::loadView('pages.eproc.berita.pdf', $isi_berita);
        $pdf->set_paper("A4", "portrait");
        return $pdf->download('berita.pdf');
    }

    public function index(){
        $berita = Berita::all();
        return view('pages.eproc.berita.index', compact('berita'));
    }

    public function create(){
        return view('pages.eproc.berita.create');
    }

    public function store(Request $request){
        $request->validate([
            'judul_berita' => 'required',
            'tanggal_published' => 'required',
            'thumbnail' => 'required',
            'isi_berita' => 'required',
        ]);

        $input_array_berita = array(
            'judul_berita' => $request['judul_berita'],
            'tanggal_published' => $request['tanggal_published'],
            'isi_berita' => $request['isi_berita'],
        );

        if($thumbnail = $request->file('thumbnail')){
            $destination_path = 'eproc/thumbnail/';
            $foto_thumbnail = date('YmdHis') . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destination_path, $foto_thumbnail);
            $input_array_berita['thumbnail'] = $foto_thumbnail;
        }

        $berita = Berita::create($input_array_berita);

        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.berita.index')->with('success', 'Berita dengan judul '.$berita->judul_berita.' berhasil ditambahkan');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.berita.index')->with('success', 'Berita dengan judul '.$berita->judul_berita.' berhasil ditambahkan');
        }
    }

    public function show($id){
        $berita = Berita::find($id);
        return view('pages.eproc.berita.show', compact('berita'));
    }

    public function edit($id){
        $berita = Berita::find($id);
        return view('pages.eproc.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'judul_berita' => 'required',
            'tanggal_published' => 'required',
            'isi_berita' => 'required',
        ]);

        $berita = Berita::findOrFail($id);

        if($thumbnail = $request->file('thumbnail')){
            $destination_path = 'eproc/thumbnail/';
            $foto_thumbnail = date('YmdHis') . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destination_path, $foto_thumbnail);
            $berita['thumbnail'] = $foto_thumbnail;
        }

        $berita->update([
            'judul_berita' => $request->judul_berita,
            'tanggal_published' => $request->tanggal_published,
            'isi_berita' => $request->isi_berita,
        ]);

        $berita = Berita::findOrFail($id);

        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.berita.index')->with('success', 'Berhasil melakukan perubahan pada berita dengan judul '.$berita->judul_berita);
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.berita.index')->with('success', 'Berhasil melakukan perubahan pada berita dengan judul '.$berita->judul_berita);
        }
    }

    public function destroy($id){
        $berita = Berita::find($id);
        
        $berita->update([
            'status_aktif' => 2,
        ]);

        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.berita.index')->with('fail', 'Berita dengan judul '.$berita->judul_berita.' berhasil dihapus');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.berita.index')->with('fail', 'Berita dengan judul '.$berita->judul_berita.' berhasil dihapus');
        }
    }
}
