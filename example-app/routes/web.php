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

    Route::prefix('/edit')->group(function () {
      Route::get('/book/{book}', [\App\Http\Controllers\BookController::class, 'edit'])->name('edit.book');
      Route::post('/book/{book}', [\App\Http\Controllers\BookController::class, 'update'])->name('update.book');
    });

    Route::prefix('/create')->group(function () {
        Route::get('/book/', [\App\Http\Controllers\BookController::class, 'create']);
        Route::post('/book/', [\App\Http\Controllers\BookController::class, 'store'])->name('store.book');
    });

    Route::prefix('/delete')->group(function () {
        Route::post('/book/{book}', [\App\Http\Controllers\BookController::class, 'destroy'])->name('destroy.book');
    });

    // List of books page
    Route::get('/books', [\App\Http\Controllers\BookController::class, 'index']);
    // List of authors page
    Route::get('/authors', [\App\Http\Controllers\AuthorController::class, 'index']);
    // List of genres page
    Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'index']);
});
