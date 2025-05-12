<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
    
    public function postLogin(Request $request)
    {
        return redirect()->intended('/dashboard');
    }

    public function loginsiswa()
    {
        return view('welcome');
    }   

    public function postLoginsiswa(Request $request)
    {
        $unique = $request->input('siswa');
        $siswa = Siswa::where('unique', $unique)->first();
        if ($siswa !== null && $siswa->nama) {
            
            session()->put('siswa', $siswa);
            return redirect()->intended(route('indexsiswa.index'));
        } else {
            return redirect()->intended(route('index.siswa'));
        }
    }


}
