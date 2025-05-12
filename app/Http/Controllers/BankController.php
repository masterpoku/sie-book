<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class BankController extends Controller
{
   
    public function index()
    {
        $title = "Bank Siswa";
        // Ambil semua kelas dengan jumlah siswa
        $kelas = Kelas::withCount('siswas')->get();
        return view('data.banksiswa', compact('title', 'kelas'));
    }
}
