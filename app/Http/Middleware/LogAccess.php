<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccessLog;
use Illuminate\Support\Facades\Auth;

class LogAccess
{
    /**
     * Handle an incoming request and log access.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            AccessLog::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'ip_address' => $request->ip(),
                'action' => $request->path(),
            ]);
        } catch (\Exception $e) {
            // Optional: log to file or monitoring if AccessLog fails
        }

        return $response;
    }
}
