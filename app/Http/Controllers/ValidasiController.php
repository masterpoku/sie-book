<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validasi;
use Illuminate\Support\Facades\DB;

class ValidasiController extends Controller
{
    public function index()
    {
        $title = 'Validasi';
        $validasi = Validasi::latest()->get();

        return view('data.validasi', compact('validasi', 'title'));
    }

    public function validator(Request $request, $validitas = null)
{
    $title = 'validator';

    $validitas = $validitas ? str_replace('Ahli ', '', $validitas) : null;

    $validator = DB::table('validasi')
        ->when($validitas, function ($query) use ($validitas) {
            return $query->where('validitas', 'like', '%' . $validitas . '%');
        })
        ->get();

    return view('data.validator', compact('validator', 'title'));
}


    public function updateData(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:validasi,id',
            'skor' => 'required|numeric',
            'catatan' => 'nullable|string'
        ]);

        $validasi = Validasi::find($request->id);
        $validasi->skor = $request->skor;
        $validasi->catatan = $request->catatan;
        $validasi->save();

        return response()->json(['message' => 'Data berhasil diperbarui!']);
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

