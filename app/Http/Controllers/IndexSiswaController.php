<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexSiswaController extends Controller
{
    public function index()
    {
        // Ambil data dari database secara manual tanpa relasi
        $mapels = DB::table('tb_mapel')->get();
        $materis = DB::table('tb_materi')->get();
        $submateris = DB::table('submateris')->get();

        // Format data sesuai struktur yang dibutuhkan di view
        $materi = [];
        $konten = [];

        foreach ($mapels as $mapel) {
            foreach ($materis as $materiItem) {
                if ($materiItem->mapel == $mapel->mapel) { // Menghubungkan materi ke mapel berdasarkan ID
                    foreach ($submateris as $submateri) {
                        if ($submateri->materi_id == $materiItem->id) { // Menghubungkan submateri ke materi berdasarkan ID
                            $materi[$mapel->mapel][$materiItem->name][] = $submateri->name;
                            $konten[$submateri->name] = $submateri->description;
                        }
                    }
                }
            }
        }

        return view('siswa.index', compact('materi', 'konten'));
    }
}
