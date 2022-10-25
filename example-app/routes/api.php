<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    Route::post('/login', [\App\Http\Controllers\api\AuthController::class, 'authenticate']);

    // Books routes
    Route::get('/get-books-by-author-name/{name}', [\App\Http\Controllers\api\InfoController::class, 'getBooksByAuthorName']);
    Route::get('/get-book-by-id/{book}', [\App\Http\Controllers\api\InfoController::class, 'getBookById']);
    Route::put('/update-book/{book}', [\App\Http\Controllers\api\InfoController::class, 'updateBookById'])->middleware('can:update,book');
    Route::delete('/delete-book/{book}', [\App\Http\Controllers\api\InfoController::class, 'deleteBookById'])->middleware('can:delete,book');
    // Authors routes
    Route::get('/get-author-books-count', [\App\Http\Controllers\api\InfoController::class, 'getAuthorBooksCount']);
    Route::get('/get-author-by-id/{author}', [\App\Http\Controllers\api\InfoController::class, 'getAuthorById']);
    Route::put('/update-author', [\App\Http\Controllers\api\InfoController::class, 'updateAuthor'])->middleware('can:update-author');
});
