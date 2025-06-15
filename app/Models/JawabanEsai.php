<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanEsai extends Model
{
    use HasFactory;

    protected $table = 'jawaban_esai';

    protected $fillable = [
        'siswa_id',
        'sub_materi',
        'jawaban',
        'penilaian',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function sub_materi()
    {
        return $this->belongsTo(Submateri::class, 'sub_materi', 'id');
        // Kolom 'sub_materi' di jawaban_esai berisi ID submateri
    }


}
