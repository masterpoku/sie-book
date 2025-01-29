<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{

    public function index()
    {
        $title = "Nilai";
        // Ambil semua kelas dengan jumlah siswa
        $kelas = Kelas::withCount('siswas')->get();
        return view('data.nilai', compact('title', 'kelas'));
    }
}
