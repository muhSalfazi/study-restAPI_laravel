<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    //
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 442);
        }
        $validated = $validator->validated();

        if (Auth::attempt($validated)) {

            $payload = [
                'name' => 'administrator', // Menggunakan tanda panah (=>) untuk mendefinisikan key-value pada array
                'role' => 'admin', // Menggunakan tanda panah (=>) untuk mendefinisikan key-value pada array
                'iat' => Carbon::now()->timestamp,
                'exp' => Carbon::now()->timestamp + 60 * 60 * 2, // Menggunakan Carbon::now()->timestamp untuk mendapatkan waktu saat ini
            ];

            $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

            return response()->json([
                'msg' => 'token berhasil di buat',
                'data' => 'Bearer ' . $token
            ], 200);
        } else {
            return response()->json([
                'msg' => 'email atau password salah'
            ], 402);
        }
    }
}