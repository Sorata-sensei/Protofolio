<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $table = 'otps';
    protected $fillable = [
        'otp',
        'user_id',
        'created_at',
        'expires_at',
    ];

    // Jika perlu, tambahkan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}