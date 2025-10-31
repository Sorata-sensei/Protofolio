<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logvisitor extends Model
{
    use HasFactory;
    protected $table = 'log';
     protected $fillable = [
        'log',
        'device',
        'date',
        'version',
    ];
}