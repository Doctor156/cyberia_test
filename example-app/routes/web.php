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


    // List of books page
    Route::get('/books', [\App\Http\Controllers\BookController::class, 'index']);
    // List of authors page
    Route::get('/authors', [\App\Http\Controllers\AuthorController::class, 'index']);
    // List of genres page
    Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'index']);

    Route::prefix('/edit')->group(function () {
        Route::get('/book/{book}', [\App\Http\Controllers\BookController::class, 'edit'])->name('edit.book');
        Route::post('/book/{book}', [\App\Http\Controllers\BookController::class, 'update'])->name('update.book');

        Route::get('/author/{author}', [\App\Http\Controllers\AuthorController::class, 'edit'])->name('edit.author');
        Route::post('/author/{author}', [\App\Http\Controllers\AuthorController::class, 'update'])->name('update.author');

        Route::get('/genre/{genre}', [\App\Http\Controllers\GenreController::class, 'edit'])->name('edit.genre');
        Route::post('/genre/{genre}', [\App\Http\Controllers\GenreController::class, 'update'])->name('update.genre');
    });

    Route::prefix('/create')->group(function () {
        Route::get('/book/', [\App\Http\Controllers\BookController::class, 'create']);
        Route::post('/book/', [\App\Http\Controllers\BookController::class, 'store'])->name('store.book');

        Route::get('/author/', [\App\Http\Controllers\AuthorController::class, 'create']);
        Route::post('/author/', [\App\Http\Controllers\AuthorController::class, 'store'])->name('store.author');

        Route::get('/genre/', [\App\Http\Controllers\GenreController::class, 'create']);
        Route::post('/genre/', [\App\Http\Controllers\GenreController::class, 'store'])->name('store.genre');
    });

    Route::prefix('/delete')->group(function () {
        Route::post('/book/{book}', [\App\Http\Controllers\BookController::class, 'destroy'])->name('destroy.book');

        Route::post('/author/{author}', [\App\Http\Controllers\AuthorController::class, 'destroy'])->name('destroy.author');

        Route::post('/genre/{genre}', [\App\Http\Controllers\GenreController::class, 'destroy'])->name('destroy.genre');
    });
});
