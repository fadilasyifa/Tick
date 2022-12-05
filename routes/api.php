<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tikets', [TiketController::class, 'index']);

//Route::get('/kategori', [KategoriController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/pesanan', PesananController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware('admin')->group(function () {
        Route::resource('tiket', TiketController::class)->except('create', 'edit',);
        Route::resource('kategori', KategoriController::class)->except('create', 'edit');
        // Route::resource('pesanan', PesananController::class)->except('create', 'edit');
    });
});
