<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilePerusahaan;

class ProfilePerusahaanController extends Controller
{
    public function index(){
        $profile_perusahaan = ProfilePerusahaan::all();
        return view('pages.compro.profile-perusahaan.index', compact('profile_perusahaan'));
    }

    public function edit($id){
        $profile_perusahaan = ProfilePerusahaan::find($id);
        return view('pages.compro.profile-perusahaan.edit', compact('profile_perusahaan'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'sejarah_perusahaan' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        $profile_perusahaan = ProfilePerusahaan::findOrFail($id);
        
        $profile_perusahaan->update([
            'sejarah_perusahaan' => $request->sejarah_perusahaan,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);
        
        if(auth()->user()->level == 1){
            return redirect()->route('compro.superadmin.profile-perusahaan')->with('success', 'Profile perusahaan berhasil diperbaharui');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.profile-perusahaan')->with('success', 'Profile perusahaan berhasil diperbaharui');
        }
    }
}
