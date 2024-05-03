<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // Tambahkan use statement untuk ProductController


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/product',[ProductController::class,'store']);

Route::put('product/{id}',[ProductController::class,'update']);
Route::delete('product/{id}',[ProductController::class,'delete']);
Route::delete('product/{id}/restore',[ProductController::class,'restore']);
Route::get('/product/{id}', [ProductController::class,'show']);