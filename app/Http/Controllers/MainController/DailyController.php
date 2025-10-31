<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
class DailyController extends Controller
{
   public function index(Request $request)
{
    $activities = Activity::orderBy('date', 'desc')->paginate(4);

    // Memastikan deskripsi tetap aman
    foreach ($activities as $activity) {
        $activity->short_description = $this->safeLimitHtml($activity->description, 140);
    }

    if ($request->ajax()) {
        return view('main.daily.partials', compact('activities'))->render();
    }

    return view('main.daily.index', compact('activities'));
}

// Fungsi untuk memotong teks HTML dengan aman
private function safeLimitHtml($text, $limit, $end = '...')
{
    $doc = new \DOMDocument();
    @$doc->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));

    $text = strip_tags($text); // Hapus semua tag HTML

    // Potong teks yang sudah dibersihkan
    $limited = \Str::limit($text, $limit, $end);

    // Muat kembali teks dalam DOM untuk menjaga tag HTML yang valid
    @$doc->loadHTML(mb_convert_encoding($limited, 'HTML-ENTITIES', 'UTF-8'));

    $body = $doc->getElementsByTagName('body')->item(0);
    return $body ? $body->nodeValue : $limited;
}

}