<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;

use App\Models\Submateri;
use Illuminate\Http\Request;

class QuisionerController extends Controller
{
    // Menampilkan daftar kuis
    public function index()
    {
        $title = 'Daftar Soal Kuis';
    
        // Eager loading untuk menghindari query N+1
        $quiz = Quiz::with(['submateri.materi.mapel'])->get();
    
        // Mengambil data materi dan submateri untuk dropdown
        $materi = Materi::all();
        $submateri = Submateri::all();
    
        return view('data.quisioner', compact('quiz', 'title', 'materi', 'submateri'));
    }
    

    // Menyimpan soal baru
        public function store(Request $request)
    {
        $request->validate([
            'submateris_id' => 'required|exists:submateris,id',
            'pertanyaan' => 'required|string',
            'jawaban_a' => 'required|string',
            'jawaban_b' => 'required|string',
            'jawaban_c' => 'required|string',
            'jawaban_d' => 'required|string',
            'jawaban_benar' => 'required|string|in:A,B,C,D',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quiz.index')->with('message', [
            'type' => 'success',
            'content' => 'Soal berhasil ditambahkan!'
        ]);
    }


    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());
        return redirect()->route('quiz.index');
    }

    public function destroy($id)
    {
        Quiz::findOrFail($id)->delete();
        return redirect()->route('quiz.index')->with('message', [
            'type' => 'success',
            'content' => 'Soal berhasil dihapus!'
        ]);
    }

}
