<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validasi;

class ValidasiController extends Controller
{
    public function index()
    {
        $title = 'Validasi';
        $validasi = Validasi::latest()->get();

        return view('data.validasi', compact('validasi', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'validitas' => 'required',
            'indikator' => 'required',
            'pernyataan' => 'required',
            'skor' => 'required|integer',
        ]);

        Validasi::create($request->all());

        return redirect()->route('validasi.index')->with('success', 'Data validasi berhasil ditambahkan');
    }
        public function update(Request $request, $id)
        {
            $request->validate([
                'validitas' => 'required',
                'indikator' => 'required',
                'pernyataan' => 'required',
                'skor' => 'required|integer',
            ]);

            $validasi = Validasi::findOrFail($id);
            $validasi->update($request->all());

            return redirect()->route('validasi.index')->with('success', 'Data validasi berhasil diperbarui');
        }


    public function destroy($id)
    {
        Validasi::findOrFail($id)->delete();
        return redirect()->route('validasi.index')->with('success', 'Data validasi berhasil dihapus');
    }
}

