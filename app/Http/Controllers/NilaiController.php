<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{

public function index()
{
    $title = "Nilai";

    // Ambil semua kelas + siswa + jawaban esai dan submateri
    $kelas = \App\Models\Kelas::with([
        'siswas' => function ($query) {
            $query->with(['jawabanEsai' => function ($q) {
                $q->leftJoin('submateris', 'jawaban_esai.sub_materi', '=', 'submateris.id')
                  ->select('jawaban_esai.*', 'submateris.name as nama_submateri');
            }]);
        }
    ])->get();

    return view('data.nilai', compact('title', 'kelas'));
}


}
