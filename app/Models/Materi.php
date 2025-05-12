<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'tb_materi';

    protected $fillable = [
        'mapel_id', // ID Mapel
        'mapel',
        'kelas',    // Kelas
        'name',     // Nama Materi
        'description'
    ];

    // Relasi ke Submateri
    public function submateris()
    {
        return $this->hasMany(Submateri::class, 'materi_id', 'id');
    }

    // Relasi ke Mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel', 'mapel');
    }
}
