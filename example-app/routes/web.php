<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [\App\Http\Controllers\web\UserController::class, 'authenticate'])->name('login');

Route::middleware(['role:admin'])->prefix('/admin')->group(function () {
    // List of available commands
    Route::get('/', function () {
        return view('admin.index');
    });
    // Edit resource page
    Route::get('/edit', function () {
        // todo
    });
    // List of books page
    Route::get('/books', [\App\Http\Controllers\BookController::class, 'index']);
    // List of authors page
    Route::get('/authors', [\App\Http\Controllers\AuthorController::class, 'index']);
    // List of genres page
    Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'index']);
});
