<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function profile(){
        $user = User::where('id', auth()->user()->id)->first();
        return view('pages.eproc.profile', compact('user'));
    }

    public function postprofile(Request $request){
        $request->validate([
            'nama_panjang' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        if($request->password){
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        }else{
            $user->email = $request->email;
            $user->save();
        }

        $user->update([
            'nama_panjang' => $request->nama_panjang,
            'email' => $request->email,
        ]);

        if(auth()->user()->level == 1){
            return redirect()->route('eproc.superadmin.profile')->with('success', 'Profile berhasil diperbaharui');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('eproc.admin.profile')->with('success', 'Profile berhasil diperbaharui');
        }
    }

    public function login(){
        return view('pages.eproc.authentications.login');
    }

    public $email, $password;

    public function postlogin(Request $request){
        $input = $request->all();


        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        $creds = array(
            'email' => $input['email'],
            'password' => $input['password'],
        );

        if(Auth::guard('web')->attempt($creds)){
            if(auth()->user()->status_aktif == 1){
                if(auth()->user()->level == 1){
                    return redirect()->route('eproc.superadmin.dashboard');
                }elseif(auth()->user()->level == 2){
                    return redirect()->route('eproc.admin.dashboard');
                }elseif(auth()->user()->level == 'perusahaan'){
                    return redirect()->route('eproc.perusahaan.dashboard');
                }else{
                    return redirect()->route('eproc.login')->with('fail', 'Bisa ditindak lanjuti sesuai level akun.');
                }
            }elseif(auth()->user()->status_aktif == 2){
                Auth::guard('web')->logout();
                return redirect()->route('eproc.login')->with('fail', 'Akun telah dihapus. hubungi pihak terkait.');
            }else{
                return redirect()->route('eproc.login')->with('fail', 'Akun telah dihapus. hubungi pihak terkait.');
            }
        }else{
            return redirect()->route('eproc.login')->with('fail', 'Email/Password yang digunakan untuk login salah. coba lagi');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('eproc.login');
    }
}
