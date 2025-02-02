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
                'description' => 'Materi dasar tentang operasi aljabar dan persamaan linier.',
            ],
            [
                'mapel' => 'Bahasa Indonesia',
                'kelas' => 'VIII',
                'name' => 'Teks Eksposisi',
                'description' => 'Pembahasan tentang struktur dan kaidah teks eksposisi.',
            ],
            [
                'mapel' => 'IPA',
                'kelas' => 'IX',
                'name' => 'Sistem Pencernaan',
                'description' => 'Penjelasan tentang organ dan proses dalam sistem pencernaan manusia.',
            ],
            [
                'mapel' => 'Bahasa Inggris',
                'kelas' => 'VII',
                'name' => 'Tenses',
                'description' => 'Penggunaan dan perbedaan berbagai jenis tenses dalam bahasa Inggris.',
            ],
            [
                'mapel' => 'Sejarah',
                'kelas' => 'VIII',
                'name' => 'Perang Dunia I',
                'description' => 'Sejarah singkat tentang penyebab dan dampak Perang Dunia I.',
            ],
        ]);
    }
}
