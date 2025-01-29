<?php
namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $title = "Daftar Mata Pelajaran";
        $mapel = Mapel::all();
        return view('data.mapel', compact('title', 'mapel'));
    }

    // Menyimpan mata pelajaran baru
    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
        ]);

        $mapel = Mapel::create($request->all());

        // Response dalam format JSON
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'mapel' => $mapel
            ]);
        }

        return redirect()->route('mapel.index')->with('message', [
            'type' => 'success',
            'content' => 'Mata pelajaran berhasil ditambahkan'
        ]);
    }

    // Memperbarui mata pelajaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update($request->all());

        // Response dalam format JSON
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'mapel' => $mapel
            ]);
        }

        return redirect()->route('mapel.index')->with('message', [
            'type' => 'success',
            'content' => 'Mata pelajaran berhasil diperbarui'
        ]);
    }

    // Menghapus mata pelajaran
    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();


        return redirect()->route('mapel.index')->with('message', [
            'type' => 'success',
            'content' => 'Mata pelajaran berhasil dihapus'
        ]);
    }
}
