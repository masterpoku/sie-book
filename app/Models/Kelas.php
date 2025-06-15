<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'tb_kelas'; // Nama tabel

    protected $fillable = ['kelas']; // Kolom yang bisa diisi
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'kelas');
    }
    
}
