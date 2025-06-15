<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KoreksiController extends Controller
{
    public function index()
{
    $kelas = DB::table('tb_siswa')
        ->select('kelas')
        ->groupBy('kelas')
        ->get();

    $data = [];

    foreach ($kelas as $k) {
        $siswaList = DB::table('tb_siswa')
            ->where('kelas', $k->kelas)
            ->get();

        foreach ($siswaList as $siswa) {
            // Ambil semua ID submateri yang dijawab oleh siswa ini
            $submateriIds = DB::table('jawaban_esai')
                ->where('siswa_id', $siswa->id)
                ->pluck('sub_materi')
                ->toArray();

            // Ambil data submateri berdasarkan ID yang tadi
            $submateriList = DB::table('submateris')
                ->whereIn('id', $submateriIds)
                ->get(['id', 'name']);

            // Tambahkan ke objek siswa
            $siswa->submateri_yang_dijawab = $submateriList;
        }

        // Simpan ke dalam array kelas
        $data[] = [
            'kelas' => $k->kelas,
            'siswa' => $siswaList
        ];
    }
    
    return view('data.koreksi.index', [
        'kelas' => $data,
        'title' => 'Koreksi Jawaban'
    ]);
}



public function show($siswaId, $submateriId)
{
    $siswa = DB::table('tb_siswa')->where('id', $siswaId)->first();

   $jawaban = DB::table('jawaban_esai as je')
    ->where('je.siswa_id', $siswaId)
    ->where('je.sub_materi', $submateriId)
    ->leftJoin('submateris as sm', 'je.sub_materi', '=', 'sm.id')
    ->leftJoin(DB::raw('
        (SELECT id, submateris_id, jawaban_benar
         FROM quizzes
         WHERE id IN (
             SELECT MIN(id) FROM quizzes GROUP BY submateris_id
         )
        ) as q
    '), 'je.sub_materi', '=', 'q.submateris_id')
    ->select(
        'je.*',
        'q.jawaban_benar as jawaban_benar',
        'je.penilaian as nilai',
        'sm.name as nama_submateri'
    )
    ->get();



    $title = "Koreksi Jawaban Esai";
    // dd($jawaban);

    return view('data.koreksi.show', compact('siswa', 'jawaban', 'title'));
}


    public function updateNilai(Request $request, $siswa_id)
{
    $request->validate([
        'penilaian' => 'array',
        'penilaian.*' => 'nullable|numeric|min:0|max:100',
    ]);

    foreach ($request->penilaian as $jawaban_id => $nilai) {
        DB::table('jawaban_esai')
            ->where('id', $jawaban_id)
            ->update(['penilaian' => $nilai]);
    }

    return redirect()->route('koreksi.index')
        ->with('message', [
            'type' => 'success',
            'content' => 'Penilaian berhasil disimpan.'
        ]);
}

}
