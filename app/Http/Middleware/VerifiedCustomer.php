<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dokumen = $request->user()->DokumenCustomer;
        if (!$dokumen) {
            abort(403, 'Anda belum melengkapi dokumen perusahaan anda');
        } elseif ($dokumen->status_id !== 3) {
            abort(403, 'Dokumen anda belum terverifikasi');
        }
        return $next($request);
    }
}
