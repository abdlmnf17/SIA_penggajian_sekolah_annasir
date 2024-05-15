<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonorMengajar extends Model
{
    use HasFactory;
    protected $table = 'honormengajars';
    protected $fillable = [
        'jam_mengajar',
        'jumlah_mengajar',
    ];
}
