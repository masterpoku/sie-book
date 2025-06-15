<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa'; // Nama tabel di database

    protected $fillable = [
        'nama',
        'kelas',
        'unique',
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'kelas');
    }
    public function jawabanEsai()
{
    return $this->hasMany(JawabanEsai::class, 'siswa_id');
}

}
