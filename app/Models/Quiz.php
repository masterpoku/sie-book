<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'submateris_id',
        'pertanyaan',
        'jawaban_benar',
    ];

    // Relasi ke Submateri
    public function submateri()
    {
        return $this->belongsTo(Submateri::class, 'submateris_id', 'id');
    }
}
