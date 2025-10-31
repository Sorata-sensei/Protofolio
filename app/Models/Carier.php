<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carier extends Model
{
    use HasFactory;
    protected $table = 'cariers';
    protected $fillable = [
        'company_name', 
        'job_status', 
        'role',
        'start_date', 
        'end_date', 
        'current_status', 
        'logo', 
        'description',
        'skills'
    ];
}