<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Carier;
use App\Models\Research;
use App\Models\Activity;
use App\Models\Logvisitor;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin/dashboard/index', [
            'greeting' => $this->getGreeting(),
            'quote' => $this->fetchRandomQuote(),
            'carier' => $this->getCarierCount(),
            'research' => $this->getResearchCount(),
            'activity' => $this->getActivityCount(),
            'visitor' => $this->getVisitorCount(),
            'menu'=>'Dashboard'
        ]);
    }
    private function getGreeting(): string
    {
        $hour = Carbon::now()->hour;

        if ($hour >= 5 && $hour < 12) {
            return 'Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            return 'Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            return 'Sore';
        }

        return 'Malam';
    }

    private function fetchRandomQuote(): array
    {
        $response = Http::get('https://indonesian-quotes-api.vercel.app/api/quotes/random');

        if ($response->successful()) {
            return $this->extractQuoteData($response->json());
        }

        return $this->getDefaultQuote();
    }

    private function extractQuoteData(array $data): array
    {
        return [
            'quote' => $data['data']['quote'] ?? 'No quote available',
            'description' => $data['data']['description'] ?? 'No description available',
            'source' => $data['data']['source'] ?? 'Unknown source',
            'category' => $data['data']['category'] ?? 'Uncategorized',
        ];
    }

    private function getDefaultQuote(): array
    {
        return [
            'quote' => 'No quote available',
            'description' => 'No description available',
            'source' => 'Unknown source',
            'category' => 'Uncategorized',
        ];
    }

    private function getCarierCount(): int
    {
        return Carier::count();
    }

    private function getVisitorCount(): int
    {
        return Logvisitor::count();
    }
    private function getResearchCount(): int
    {
        return Research::count();
    }
     private function getActivityCount(): int
    {
        return Activity::count();
    }
}