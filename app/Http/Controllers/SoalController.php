<?php

namespace App\Http\Controllers;

use App\Models\JawabanEsai;
use App\Models\Quiz;
use App\Models\Submateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function index()
    {
        return view('siswa.postest');
    }


    public function jawabEsai(Request $request)
    {
        $request->validate([
            'sub_materi' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        DB::table('jawaban_esai')->insert([
            'siswa_id' => session('siswa')->id,
            'sub_materi' => $request->sub_materi,
            'jawaban' => $request->jawaban,
            'created_at' => now(),
        ]);
    
        return back()->with('message', [
            'type' => 'success',
            'content' => 'Jawaban kamu berhasil dikirim!',
        ]);
    }
    


public function postest($submateriSlug)
{
    // Ambil submateri berdasarkan ID atau nama
    $submateri = Submateri::where('id', $submateriSlug)
                          ->orWhere('name', $submateriSlug)
                          ->firstOrFail();

    $siswaId = session('siswa')->id;

    // Cek apakah sudah pernah menjawab
    $sudahJawab = JawabanEsai::where('siswa_id', $siswaId)
                              ->where('sub_materi', $submateri->id)
                              ->exists();
    // dd($siswaId);

    if ($sudahJawab) {
        return redirect()->route('indexsiswa.soal')->with('error', 'Kamu sudah mengerjakan postest ini.');
    }

    // Ambil soalnya
    $quizzes = Quiz::where('submateris_id', $submateri->id)->get();

    return view('siswa.postest', compact('submateri', 'quizzes'));
}




    public function submitPostest(Request $request, $submateriId)
    {
        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|string',
        ]);
    
        $siswaId = session('siswa')->id;
        $subMateriNama = $request->input('sub_materi', ''); // optional kalau ada
    
        foreach ($request->jawaban as $quiz_id => $isi_jawaban) {
            DB::table('jawaban_esai')->insert([
                'siswa_id' => $siswaId,
                'sub_materi' => $submateriId, // pastikan kolom ini ada di tabel lu
                'jawaban' => $isi_jawaban,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        return view('siswa.terimakasih');
    }
    

}

