<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComproController extends Controller
{
    public function profile(){
        $user = User::where('id', auth()->user()->id)->first();
        return view('pages.compro.profile', compact('user'));
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
            return redirect()->route('compro.superadmin.profile')->with('success', 'Profile berhasil diperbaharui');
        }elseif(auth()->user()->level == 2){
            return redirect()->route('compro.admin.profile')->with('success', 'Profile berhasil diperbaharui');
        }elseif(auth()->user()->level == 3){
            return redirect()->route('compro.creator.profile')->with('success', 'Profile berhasil diperbaharui');
        }elseif(auth()->user()->level == 4){
            return redirect()->route('compro.helpdesk.profile')->with('success', 'Profile berhasil diperbaharui');
        }
    }

    public function login(){
        return view('pages.compro.authentications.login');
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
                    return redirect()->route('compro.superadmin.dashboard');
                }elseif(auth()->user()->level == 2){
                    return redirect()->route('compro.admin.dashboard');
                }elseif(auth()->user()->level == 3){
                    return redirect()->route('compro.creator.dashboard');
                }elseif(auth()->user()->level == 4){
                    return redirect()->route('compro.helpdesk.dashboard');
                }
            }elseif(auth()->user()->status_aktif == 2){
                Auth::guard('web')->logout();
                return redirect()->route('compro.login')->with('fail', 'Akun telah dihapus. hubungi pihak terkait.');
            }else{
                return redirect()->route('compro.login')->with('fail', 'Akun telah dihapus. hubungi pihak terkait.');
            }
        }else{
            return redirect()->route('compro.login')->with('fail', 'Email/Password yang digunakan untuk login salah. coba lagi');
        }
    }

    // public function register(){
    //     return view('pages.compro.authentications.register');
    // }

    // public function postregister(Request $request){
    //     $request->validate([
    //         'nama_panjang' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:8',
    //     ]);

    //     $user = array(
    //         'nama_panjang' => $request['nama_panjang'],
    //         'email' => $request['email'],
    //         'password' => bcrypt($request['password']),
    //     );

    //     User::create($user);

    //     return redirect()->route('compro.login')->with('success', 'Pembuatan akun berhasil');
    // }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('compro.login');
    }
}
