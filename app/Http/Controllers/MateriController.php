<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $title = 'Daftar Materi';
        $materi = Materi::all();
        $mapelList = Mapel::all();
        $kelasList = Kelas::all();
        return view('data.materi', compact('title', 'materi', 'mapelList', 'kelasList'));
    }

    public function store(Request $request)
{
    $request->validate([
        'mapel' => 'required|string|max:255',
        'kelas' => 'required|string|max:100',
        'name' => 'required|string|max:255',
    ]);

    Materi::create($request->all());

    return redirect()->route('materi.index')->with('message', [
        'type' => 'success',
        'content' => 'Materi added successfully!'
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'mapel' => 'required|string|max:255',
        'kelas' => 'required|string|max:100',
        'name' => 'required|string|max:255',
    ]);

    $materi = Materi::findOrFail($id);
    $materi->update($request->all());

    return redirect()->route('materi.index')->with('message', [
        'type' => 'success',
        'content' => 'Materi updated successfully!'
    ]);
}


    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->route('materi.index')->with('message', ['type' => 'success', 'content' => 'Materi deleted successfully!']);
    }
}
