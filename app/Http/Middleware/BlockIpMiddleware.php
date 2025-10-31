<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Daftar IP yang diizinkan (whitelist)
        $whitelistIps = [
            '125.163.152.54',  // IP yang diizinkan
            '127.0.0.1',  // IP lainnya
        ];

        // Ambil IP pengunjung
        $clientIp = $request->ip();

        // Cek apakah IP pengunjung ada di whitelist
        if (!in_array($clientIp, $whitelistIps)) {
            // Jika tidak ada, beri respons error (misalnya 403 Forbidden)
            return abort(403);;
        }

        // Jika IP ada di whitelist, lanjutkan ke request berikutnya
        return $next($request);
    }
}