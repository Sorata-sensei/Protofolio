<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'type',
        'category',
        'description',
    ];

    // Scope untuk dana masuk (fund)
    public function scopeFunds($query)
    {
        return $query->where('type', 'fund');
    }

    // Scope untuk pengeluaran (expense)
    public function scopeExpenses($query)
    {
        return $query->where('type', 'expense');
    }
}