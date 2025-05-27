<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Submateri;
use Illuminate\Http\Request;
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
        // Mencari data Submateri berdasarkan slug atau nama; firstOrFail() akan 404 jika tidak ditemukan
        $submateri = Submateri::where('id', $submateriSlug)
                              ->orWhere('name', $submateriSlug)
                              ->firstOrFail();

        // Mengambil semua soal (quiz) yang terkait dengan submateri tersebut
        $quizzes = Quiz::where('submateris_id', $submateri->id)->get();

        // Kirim data ke view 'siswa.postest'
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
    
        return redirect()->route('siswa.postest', ['submateri' => $submateriId])
            ->with('message', [
                'type' => 'success',
                'content' => 'Jawaban kamu berhasil dikirim!',
            ]);
    }
    

}

