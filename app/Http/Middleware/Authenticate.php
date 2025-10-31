<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {   
        // Cek apakah pengguna mengharapkan JSON
        if ($request->expectsJson()) {
            return null;
        }

        // Cek apakah OTP ada di session
        if ($request->session()->has('otp')) {
            // Jika ada OTP, arahkan ke halaman OTP
            return route('login'); // Ganti dengan route yang sesuai untuk halaman OTP
        }

        // Jika tidak ada OTP, arahkan ke halaman login
        return route('login');
    }
}