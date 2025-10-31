<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
class GenerateOtp extends Command
   {
       protected $signature = 'otp:generate';
    protected $description = 'Generate OTP';

    public function handle()
    {
        // Menghasilkan OTP dengan kombinasi huruf dan angka
        $otp = $this->generateOtp(6); // Misalnya, 6 karakter

        Otp::create([
            'otp' => $otp,
            'user_id' => 1, // Ganti dengan ID user yang sesuai
            'created_at' => now(),
            'expires_at' => now()->addMinutes(5), // Contoh masa berlaku 5 menit
        ]);

        $toEmail = 'indraasrori@gmail.com'; // Ganti dengan alamat email penerima
        $subject = 'Kode rahasia';
        $message = $otp;

        // Kirim email
        Mail::raw($message, function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)
                    ->subject($subject);
                    
        });
        $this->info('OTP generated: ' . $otp);
    }

    private function generateOtp($length = 6)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $otp;
    }
   }