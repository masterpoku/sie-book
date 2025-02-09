<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submateri extends Model
{
    use HasFactory;

    protected $table = 'submateris';

    protected $fillable = [
        'materi_id',
        'name',
        'description',
    ];

    // Relasi ke Materi
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel', 'mapel');
    }
}
