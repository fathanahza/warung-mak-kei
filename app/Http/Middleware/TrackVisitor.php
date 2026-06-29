<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     * Log setiap kunjungan halaman publik.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya log GET request, bukan admin, bukan AJAX, bukan bot umum
        if (
            $request->isMethod('GET') &&
            !$request->is('admin/*') &&
            !$request->is('login') &&
            !$request->is('sitemap.xml') &&
            !$request->wantsJson() &&
            $response->getStatusCode() === 200
        ) {
            // Hindari double logging dalam satu session menit yang sama
            $cacheKey = 'visitor_' . $request->ip() . '_' . $request->path() . '_' . date('YmdHi');

            if (!cache()->has($cacheKey)) {
                cache()->put($cacheKey, true, 60); // Cache 60 detik

                try {
                    VisitorLog::create([
                        'ip_address' => $request->ip(),
                        'halaman'    => '/' . $request->path(),
                        'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                        'referrer'   => substr($request->headers->get('referer') ?? '', 0, 500),
                    ]);
                } catch (\Exception $e) {
                    // Silent fail — jangan sampai error log mengganggu response
                    logger()->warning('TrackVisitor error: ' . $e->getMessage());
                }
            }
        }

        return $response;
    }
}
