<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOtpVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if ($request->user()) {
            // Check if OTP verification session key exists
            if (!$request->session()->has('otp')) {
                // Redirect to OTP verification page if not verified
                return redirect()->route('login.otp');
            }
        }

        // Allow request onward if OTP is verified
        return $next($request);
    }
}