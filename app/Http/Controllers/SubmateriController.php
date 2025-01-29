<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Submateri;
use App\Models\Materi;
use Illuminate\Http\Request;

class SubmateriController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $title = 'Daftar Submateri';
        $submateris = Submateri::with('materi')->get(); // Memuat relasi materi
        $materis = Materi::all(); // Mengambil data Materi
        return view('data.submateri', compact('submateris', 'materis', 'title'));
    }
    

    // Store a newly created resource in storage
    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'materi_id' => ['required', 'exists:tb_materi,id'], // Menggunakan tb_materi
        'name' => ['required', 'string', 'max:255'],
        'description' => 'nullable|string|max:65535',
    ]);

    // Membuat Submateri baru
    Submateri::create([
        'materi_id' => $request->materi_id,
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('submateris.index')->with('message', [
        'type' => 'success',
        'content' => 'Materi berhasil ditambahkan'
    ]);
}


    // Show the specified resource
    public function show($id)
    {
        $submateri = Submateri::findOrFail($id);  // Mencari Submateri berdasarkan ID
        return response()->json($submateri);  // Mengembalikan response dalam format JSON
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'materi_id' => ['required', 'exists:tb_materi,id'], // Menggunakan tb_materi
        'name' => ['required', 'string', 'max:255'],
    ]);

    // Mencari Submateri yang akan diperbarui
    $submateri = Submateri::findOrFail($id);

    // Update data Submateri
    $submateri->update([
        'materi_id' => $request->materi_id,
        'name' => $request->name,
        'description' => $request->description,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('submateris.index')->with('message', [
        'type' => 'success',
        'content' => 'Materi berhasil diperbarui'
    ]);
}


    // Remove the specified resource from storage
    public function destroy($id)
    {
        $submateri = Submateri::findOrFail($id);
        $submateri->delete();

        return response()->json([
            'message' => 'Materi berhasil dihapus',
        ], 200);
    }

    // Get details of a specific Materi
    public function details($id)
    {
        $submateri = Submateri::with('details')->findOrFail($id);  // Mengambil data Submateri beserta detailnya
        return response()->json($submateri->details);  // Mengembalikan data detail dalam format JSON
    }

    // Delete specific detail from a Submateri
    public function deleteDetail($submateriId, $detailId)
    {
        $submateri = Submateri::findOrFail($submateriId);
        $detail = $submateri->details()->findOrFail($detailId);
        $detail->delete();

        return response()->json([
            'message' => 'Detail berhasil dihapus',
            'materi_id' => $submateri->materi_id,
        ], 200);
    }
    public function getByMateri($materiId)
{
    $submateri = Submateri::where('materi_id', $materiId)->get();
    return response()->json($submateri);
}

}
