<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into tb_materi table
        DB::table('tb_materi')->insert([
            [
                'mapel' => 'Matematika',
                'kelas' => 'VII',
                'name' => 'Aljabar',
            ],
            [
                'mapel' => 'Bahasa Indonesia',
                'kelas' => 'VIII',
                'name' => 'Teks Eksposisi',
            ],
            [
                'mapel' => 'IPA',
                'kelas' => 'IX',
                'name' => 'Sistem Pencernaan',
            ],
            [
                'mapel' => 'Bahasa Inggris',
                'kelas' => 'VII',
                'name' => 'Tenses',
            ],
            [
                'mapel' => 'Sejarah',
                'kelas' => 'VIII',
                'name' => 'Perang Dunia I',
            ],
        ]);
    }
}
