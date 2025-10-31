<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        // Initialize query
        $query = Visitor::query();
        $menu = 'Visitor';
        // Search functionality
         if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search); // Mengubah input pencarian menjadi huruf kecil
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(ip) LIKE ?', "%{$search}%")
                  ->orWhereRaw('LOWER(device) LIKE ?', "%{$search}%")
                  ->orWhereRaw('LOWER(country_name) LIKE ?', "%{$search}%")
                  ->orWhereRaw('LOWER(isp) LIKE ?', "%{$search}%");
            });
        }

        // Date filter
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('date', '>=', Carbon::parse($request->date_from));
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('date', '<=', Carbon::parse($request->date_to));
        }

        // Country filter
        if ($request->has('country') && $request->country != '') {
            $query->where('country_name', $request->country);
        }

        // ISP filter
        if ($request->has('isp') && $request->isp != '') {
            $query->where('isp', $request->isp);
        }

        // Get logs with pagination
        $logs = $query->orderBy('date', 'desc')->paginate(10);

        return view('admin.visitor.index', compact('logs','menu'));
    }
   public function month(Request $request)
{
    $menu = 'Visitor Month';
    $year = $request->input('year', now()->year); // Default tahun saat ini jika tidak ada input

    $monthlyVisitors = Visitor::select(\DB::raw('MONTH(date) as month'), \DB::raw('COUNT(*) as total'))
        ->whereYear('date', $year) // Filter berdasarkan tahun
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->map(function ($item) {
            return [
                'month' => Carbon::create()->month($item->month)->format('F'),
                'total' => $item->total,
            ];
        });

    $months = $monthlyVisitors->pluck('month')->toArray();
    $totals = $monthlyVisitors->pluck('total')->toArray();

    return view('admin.visitor.visitor_month_chart', compact('months', 'totals', 'year','menu'));
}

public function daily(Request $request)
{
    $year = $request->input('year', now()->year); // Default tahun saat ini
    $month = $request->input('month', now()->month); // Default bulan saat ini
    $menu = 'Daily Visitors for ' . \Carbon\Carbon::create()->month($month)->format('F') . ' ' . $year;

    // Dapatkan jumlah hari dalam bulan
    $daysInMonth = Carbon::create($year, $month)->daysInMonth;

    // Ambil data pengunjung per hari, menggunakan DATE(date) untuk mengabaikan waktu
    $dailyVisitors = Visitor::select(\DB::raw('DAY(DATE(date)) as day'), \DB::raw('COUNT(*) as total'))
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->groupBy(\DB::raw('DAY(DATE(date))')) // Kelompokkan berdasarkan tanggal saja
        ->orderBy('day')
        ->pluck('total', 'day')
        ->toArray();

    // Pastikan semua tanggal ada di array, meskipun jumlahnya 0
    $days = range(1, $daysInMonth);
    $totals = array_map(function ($day) use ($dailyVisitors) {
        return $dailyVisitors[$day] ?? 0; // Default 0 jika tidak ada data
    }, $days);
//dd($dailyVisitors);
    return view('admin.visitor.visitor_daily_chart', compact('days', 'totals', 'year', 'month','menu'));
}


 // Fungsi menampilkan chart pie dengan warna konsisten untuk setiap negara
    public function countryChart(Request $request)
    {
        // Filter tahun
        $year = $request->input('year', now()->year);
        $menu = 'Country Visitors for ' . $year;

        // Ambil data negara dan jumlah pengunjung berdasarkan tahun
        $countries = Visitor::select('country_name', \DB::raw('COUNT(*) as total'))
            ->whereYear('date', $year)
            ->groupBy('country_name')
            ->orderBy('total', 'desc')
            ->get();

        // Palet warna statis untuk semua negara
        $colorPalette = [
            'Indonesia' => '#FF5733',
            'United States' => '#4287f5',
            'India' => '#FF9933',
            'China' => '#FF3333',
            'Germany' => '#33FF57',
            'France' => '#5733FF',
            'Japan' => '#FFC300',
            'Brazil' => '#33FFF5',
            'Russian Federation' => '#FF33FF',
            'Australia' => '#F57C33',
            'Canada' => '#85C1E9',
            'Mexico' => '#F1948A',
            'Italy' => '#A569BD',
            'Spain' => '#F7DC6F',
            'South Africa' => '#48C9B0',
            'South Korea' => '#5DADE2',
            'Argentina' => '#F5B7B1',
            'Netherlands (Kingdom of the)' => '#D2B4DE',
            'Turkiye' => '#FAD7A0',
            'Malaysia' => '#76D7C4',
            'Viet Nam' => '#AED6F1',
            'Thailand' => '#E59866',
            'Philippines' => '#D7BDE2',
            'Pakistan' => '#F9E79F',
            'Egypt' => '#7FB3D5',
            'Saudi Arabia' => '#FADBD8',
            'United Kingdom' => '#C39BD3',
            'Ukraine' => '#F5CBA7',
            'Poland' => '#73C6B6',
            'Singapore' => '#FFB6C1',
            'New Zealand' => '#00FF7F',
            'Norway' => '#4682B4',
            'Sweden' => '#FF4500',
            'Denmark' => '#8B0000',
            'Finland' => '#2E8B57',
            'Belgium' => '#6A5ACD',
            'Switzerland' => '#8B4513',
            'Portugal' => '#D2691E',
            'Greece' => '#5F9EA0',
            'Austria' => '#A52A2A',
            'Hungary' => '#556B2F',
            'Ireland' => '#B22222',
            'Israel' => '#CD5C5C',
            'Chile' => '#F08080',
            'Colombia' => '#E9967A',
            'Peru' => '#FA8072',
            'Czech Republic' => '#FFA07A',
            'Czechia'=> '#FFA07A',
            'Slovakia' => '#FF7F50',
            'Romania' => '#FF6347',
            'Bulgaria' => '#FF4500',
            'Croatia' => '#FF8C00',
            'Slovenia' => '#FFD700',
            'Lithuania' => '#FFFF00',
            'Latvia' => '#9ACD32',
            'Estonia' => '#ADFF2F',
            'Luxembourg' => '#7FFF00',
            'Cyprus' => '#32CD32',
            'Malta' => '#00FF00',
            'Iceland' => '#00FA9A',
            'Greenland' => '#00FFFF',
            'Fiji' => '#40E0D0',
            'Papua New Guinea' => '#48D1CC',
            'Samoa' => '#AFEEEE',
            'Tonga' => '#4682B4',
            'Vanuatu' => '#5F9EA0',
            'Kiribati' => '#6495ED',
            'Micronesia' => '#7B68EE',
            'Palau' => '#6A5ACD',
            'Marshall Islands' => '#483D8B',
            'Solomon Islands' => '#4B0082',
            'Tuvalu' => '#800080',
            '-' => '#808080' ,
            'United States of America'=>'#ff32ff',
            'United Kingdom of Great Britain and Northern Ireland'=>'#00FFFF',
            'Hong Kong'=>'#ff00ff',
            'Bangladesh'=>'#ff002f',
            'Serbia'=>'#ff0243',
            'Cambodia'=>'#f32341',
            'Seychelles'=>'#f12342'
        ];

        $chartData = $countries->map(function ($country) use ($colorPalette) {
            $color = $colorPalette[$country->country_name] ?? null;
            if (!$color) {
                throw new \Exception("Warna tidak ditemukan untuk negara: " . $country->country_name);
            }

            return [
                'name' => $country->country_name,
                'value' => $country->total,
                'color' => $color,
            ];
        });

        return view('admin.visitor.visitor_country_chart', [
            'chartData' => $chartData,
            'year' => $year,
            'menu' => $menu
        ]);
    }



}