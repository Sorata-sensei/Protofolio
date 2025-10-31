<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
   class DiscordBotService
   {
       protected $client;
       protected $token;

       public function __construct()
       {
           $this->client = new Client();
           $this->token = env('DISCORD_BOT_TOKEN'); // Pastikan Anda menambahkan token ke .env
       }

       public function sendMessage($channelId, $message, $embed = null)
        {
            $data = [
                'content' => $message,
            ];

            // Jika ada embed, tambahkan ke data
            if ($embed) {
                $data['embeds'] = [$embed];
            }

            $this->client->post("https://discord.com/api/v10/channels/{$channelId}/messages", [
                'headers' => [
                    'Authorization' => "Bot {$this->token}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);
        }

       public function sendErrorNotification($errorMessage,$url)
        {
             try {
        // Membuat embed untuk notifikasi error
                    $embed = [
                        'title' => '😤 Error Detected',
                        'description' => "Terjadi Masalah pada halaman $url",
                        'fields' => [
                            [
                                'name' => 'Pesan Error',
                                'value' => $errorMessage,
                            ],
                            [
                                'name' => 'Waktu',
                                'value' => Carbon::now()->translatedFormat('l, d F Y H:i:s'), // Format waktu
                            ],
                        ],
                        'color' => hexdec("ff0000"), // Warna merah untuk error
                        'footer' => [
                            'text' => "Notifikasi Error",
                        ],
                    ];

                    $response = $this->client->post("https://discord.com/api/v10/channels/1318110160723640342/messages", [
                        'headers' => [
                            'Authorization' => "Bot {$this->token}",
                            'Content-Type' => 'application/json',
                        ],
                        'json' => [
                            'embeds' => [$embed], // Mengirim embed
                        ],
                    ]);

                    // Log respons untuk debugging
                    Log::info('Discord response: ' . $response->getBody());
                } catch (\Exception $e) {
                    // Log error jika pengiriman gagal
                    Log::error('Failed to send notification to Discord: ' . $e->getMessage());
                }
        }

      
   }