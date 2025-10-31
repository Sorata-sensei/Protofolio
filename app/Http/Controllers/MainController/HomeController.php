<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\DiscordBotService;
use Illuminate\Support\Facades\Log;
use Browser;
use Carbon\Carbon;
use GeoIp2\Database\Reader;
use App\Models\Logvisitor;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    protected $discordBot;

    public function __construct(DiscordBotService $discordBot)
    {
        $this->discordBot = $discordBot; // Siap-siap buat kirim pesan ke Discord
    }

    public function index(Request $request)
    {
        try {
                $user = $this->getUserById(1); // Ambil info user, biar tahu siapa yang datang
                $browserInfo = $this->getBrowserInfo(); // Dapatkan info browser pengunjung
                $embed = $this->createEmbedMessage($browserInfo); // Bikin pesan embed buat Discord
               
                // Cek IP, kalau bukan IP yang dikecualikan
                if ($request->ip() != '127.0.0.11') {
                    $now = Carbon::now();
                    $logEntry = visitor::where('ip', $request->ip())
                        ->whereBetween('date', [
                            $now->subMinutes(10)->format('Y-m-d H:i:s'), 
                            Carbon::now()->format('Y-m-d H:i:s')
                        ]) // Memeriksa antara satu jam yang lalu dan sekarang
                        ->first();

                    // Kalau belum ada log, ya bikin baru
                    if (!$logEntry) {
                        // Ambil data dari API
                     $response = Http::get("https://api.iplocation.net/?ip={$request->ip()}");
                        $data = $response->json();

                        // Simpan data pengunjung
                        Visitor::create([
                            'ip' => $request->ip(),
                            'ip_number' => $data['ip_number'] ?? 'Not Found', // Ambil IP number dari API
                            'ip_version' => $data['ip_version'] ?? 4, // Ambil versi IP dari API, default ke 4
                            'country_name' => $data['country_name'] ?? 'Not Found', // Ambil nama negara dari API
                            'country_code2' => $data['country_code2'] ?? 'Not Found', // Ambil kode negara dari API
                            'isp' => $data['isp'] ?? 'Not Found', // Ambil ISP dari API
                            'device' => $browserInfo['platform'],
                            'version' => $browserInfo['version'],
                            'date' => Carbon::now(),
                        ]);
                    }

                    // Kirim pesan ke Discord, kasih tahu ada pengunjung baru
                    $embed = $this->createEmbedMessage($browserInfo); // Bikin pesan embed buat Discord
                    $this->discordBot->sendMessage(1318121877369126922, "Ada Pengunjung Baru:", $embed);
                }

            // Tampilkan halaman utama
            return view('main/home/index', ['user' => $user]);
        } catch (\Exception $e) {
            // Kalau ada error, handle dengan baik
            return $this->handleError($e);
        }
    }

    private function getUserById(int $id): User
    {
        $user = User::find($id);
        if (!$user) {
            throw new \Exception('User not found'); // Kalau user nggak ketemu, kasih tau
        }
        return $user;
    }

    private function getBrowserInfo(): array
    {
        $browser = Browser::detect(); // Deteksi browser yang dipakai
        return [
            'name' => $browser->browserFamily(),
            'version' => $browser->browserVersion(),
            'platform' => $browser->platformName(),
            'isWindows'=> $browser->isWindows(),
            'isMac' => $browser->isMac(),
            'isLinux'=> $browser->isLinux(),
            'isAndroid'=> $browser->isAndroid()
        ];
    }

    private function createEmbedMessage(array $browserInfo): array
    {
        $currentDateTime = Carbon::now()->translatedFormat('l, d F Y');

        return [
            'title' => 'Informasi Pengunjung',
            'description' => "Pengunjung baru telah terdeteksi.",
            'fields' => [
                [
                    'name' => 'Browser',
                    'value' => $browserInfo['name'],
                    'inline' => true,
                ],
                [
                    'name' => 'Platform',
                    'value' => $browserInfo['platform'],
                    'inline' => true,
                ],
            ],
            'color' => hexdec("198754"),
            'footer' => [
                'text' => "Tanggal $currentDateTime",
            ],
        ];
    }

    private function handleError(\Exception $e)
    {
        Log::error('Error in index method: ' . $e->getMessage()); // Catat error di log
        $this->discordBot->sendErrorNotification($e->getMessage(), 'HomePage'); // Kirim notifikasi error ke Discord
        abort(500); // Abort dengan status 500
    }
}