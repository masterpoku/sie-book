<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $title = "Data Siswa";
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        return view('data.siswa', compact('title', 'siswa','kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'unique' => 'required|string|max:50|unique:tb_siswa,unique',
        ]);

        Siswa::create($request->all());

        return redirect()->back()->with('message', [
            'type' => 'success',
            'content' => 'Siswa berhasil ditambahkan!',
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'unique' => 'required|string|max:50|unique:tb_siswa,unique,' . $siswa->id,
        ]);

        $siswa->update($request->all());

        return redirect()->back()->with('message', [
            'type' => 'success',
            'content' => 'Data siswa berhasil diperbarui!',
        ]);
    }

    public function destroy(Siswa $siswa)
    {
        try {
            $siswa->delete();
    
            return redirect()->route('siswa.index')->with('message', [
                'type' => 'success',
                'content' => 'Data siswa berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('message', [
                'type' => 'danger',
                'content' => 'Terjadi kesalahan saat menghapus siswa.',
            ]);
        }
    }
    
}
