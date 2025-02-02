<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{


    
    public function index()
    {
        $title = "Kelas";
         // Mengambil semua data kelas
         $kelas = Kelas::all();
        return view('data.kelas', compact('title', 'kelas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);

        Kelas::create(['kelas' => $request->kelas]);

        return redirect()->route('kelas.index')->with('message', [
            'type' => 'success',
            'content' => 'Kelas berhasil ditambahkan!',
        ]);
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    // Mengupdate kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update(['kelas' => $request->kelas]);

        return redirect()->route('kelas.index')->with('message', [
            'type' => 'success',
            'content' => 'Kelas berhasil diperbarui!',
        ]);
    }

    // Menghapus kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('message', [
            'type' => 'success',
            'content' => 'Kelas berhasil dihapus!',
        ]);
    }
}
