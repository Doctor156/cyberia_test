<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    Route::post('/login', [\App\Http\Controllers\api\AuthController::class, 'authenticate'])->name('login');
});

Route::post('/login', function (Request $request) {
    return view('welcome');
})->name('login');
