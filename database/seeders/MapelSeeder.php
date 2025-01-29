<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan beberapa data mata pelajaran
        DB::table('tb_mapel')->insert([
            ['mapel' => 'Matematika', 'created_at' => now(), 'updated_at' => now()],
            ['mapel' => 'Bahasa Indonesia', 'created_at' => now(), 'updated_at' => now()],
            ['mapel' => 'Bahasa Inggris', 'created_at' => now(), 'updated_at' => now()],
            ['mapel' => 'IPA', 'created_at' => now(), 'updated_at' => now()],
            ['mapel' => 'IPS', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
