<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;
    protected $table = 'validasi';
    protected $fillable = ['validitas', 'indikator', 'pernyataan', 'skor', 'catatan'];

}
