<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'login:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            ])->withInput();
        }

        $response = $next($request);

        // If login failed, record the attempt
        if ($request->isMethod('POST') && $response->isRedirection()) {
            RateLimiter::hit($key, 900); // 15 minutes
        }

        return $response;
    }
}