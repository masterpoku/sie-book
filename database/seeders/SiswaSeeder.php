<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'nama' => 'Ahmad Fauzan',
            'kelas' => '8A',
            'unique' => 'fauzan123',
        ]);

        Siswa::create([
            'nama' => 'Rina Anggraini',
            'kelas' => '8B',
            'unique' => 'rina321',
        ]);

        Siswa::create([
            'nama' => 'Budi Santoso',
            'kelas' => '8C',
            'unique' => 'budi001',
        ]);
    }
}
