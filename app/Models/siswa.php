<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
    ];
}
