<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $jwt = $request->bearerToken();

        // cek jika jwt null atau kosong
        if ($jwt == 'null' || $jwt == '') {
            return response()->json([
                'msg' => 'akses di tolak, token tidak ditemukan'
            ], 401);
        } else {
            $jwtDecoded = JWT::decode($jwt, new Key(env('JWT_SECRET_KEY'), 'HS256'));

            // jika token itu milik admin
            if ($jwtDecoded->role == 'admin') {
                return $next($request);
            }

            // jika tidak, maka kembalikan respons akses ditolak
            return response()->json([
                'msg' => 'Akses ditolak, token tidak valid'
            ], 401);
        }
    }
}