<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;
    protected $table = 'journals';
     protected $fillable = [
        'title',
        'abstract',
        'authors',
        'publisher',
        'journal_link',
        'year',
    ];
    public function formattedAuthors()
{
    // Mengganti pemisah dari ';' menjadi ',' untuk data yang Anda berikan
    $authors = explode(',', $this->authors);
    return implode(', ', array_map(function ($author) {
        $names = explode(' ', trim($author)); // Memisahkan nama berdasarkan spasi
        $lastName = array_pop($names); // Ambil nama belakang
        $initials = array_map(function ($n) {
            return strtoupper($n[0]); // Ambil huruf pertama dari nama depan
        }, $names);
        return implode('', $initials) . ' ' . $lastName; // Format: Inisial Nama Belakang
    }, $authors));
}

}