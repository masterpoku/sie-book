<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        
        // Menghitung jumlah mapel, kelas, dan siswa
        $mapelCount = Mapel::count();
        $kelasCount = Kelas::count();
        $siswaCount = Siswa::count();

        return view('dashboard', compact('title', 'mapelCount', 'kelasCount', 'siswaCount'));
    }
}
