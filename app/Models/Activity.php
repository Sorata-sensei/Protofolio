<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
     use HasFactory;
     // Tentukan nama tabel jika berbeda dari konvensi
    protected $table = 'activities';

    // Tentukan kolom yang dapat diisi massal
    protected $fillable = [
        'title',
        'description',
        'date',
        'image',
    ];
}