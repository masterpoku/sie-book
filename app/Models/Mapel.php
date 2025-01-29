<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'tb_mapel';

    protected $fillable = ['mapel'];

    // Relasi dari Mapel ke Materi (satu mapel memiliki banyak materi)
    public function materis()
    {
        return $this->hasMany(Materi::class, 'mapel_id', 'id');
    }
}
