<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['isAdmin'])->prefix('/admin')->group(function () {
    // List of available commands
    Route::get('/', function () {
        // todo
    });
    // Edit resource page
    Route::get('/edit', function () {
        // todo
    });
    // List of books page
    Route::get('/books', function () {
        // todo
    });
    // List of genres page
    Route::get('/genre', function () {
        // todo
    });
    // List of users page
    Route::get('/users', function () {
        // todo
    });
});
