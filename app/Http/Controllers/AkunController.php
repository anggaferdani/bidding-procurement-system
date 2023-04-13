<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index(){
        $akun = User::all();
        return view('pages.compro.akun.index', compact('akun'));
    }

    public function create(){
        return view('pages.compro.akun.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'level' => 'required',
        ]);

        $input_array_akun = array(
            'nama_panjang' => $request['nama_panjang'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'level' => $request['level'],
        );

        $akun = User::create($input_array_akun);

        return redirect()->route('compro.superadmin.akun.index')->with('success', 'Akun dengan alamat email '.$akun->email.' berhasil ditambahkan');
    }

    public function show($id){
        $akun = User::find($id);
        return view('pages.compro.akun.show', compact('akun'));
    }

    public function edit($id){
        $akun = User::find($id);
        return view('pages.compro.akun.edit', compact('akun'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required',
        ]);

        $akun = User::find($id);
        
        $akun->update([
            'nama_panjang' => $request->nama_panjang,
            'email' => $request->email,
        ]);
        
        return redirect()->route('compro.superadmin.akun.index')->with('success', 'Akun dengan alamat email '.$akun->email.' berhasil melakukan perubahan');
    }

    public function destroy($id){
        $akun = User::find($id);
        
        $akun->update([
            'status_aktif' => 2,
        ]);

        return redirect()->route('compro.superadmin.akun.index')->with('fail', 'Akun dengan alamat email '.$akun->email.' berhasil dihapus');
    }
}
