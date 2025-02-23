<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Validasi;

class ValidasiSeeder extends Seeder
{
    public function run()
    {
        Validasi::create([
            'validitas' => 'Ahli Media',
            'indikator' => 'Tampilan E-learning',
            'pernyataan' => 'Sangat bagus dan interaktif, memudahkan pengguna dalam memahami materi.',
            'skor' => 4,
            'catatan' => 'halo bos iki catatan'
        ]);

        Validasi::create([
            'validitas' => 'Ahli Materi',
            'indikator' => 'Aspek Muatan',
            'pernyataan' => 'Materi yang disampaikan sangat relevan dan memiliki bobot yang baik.',
            'skor' => 3,
            'catatan' => 'halo bos iki catatan'
       
        ]);
    }
}
