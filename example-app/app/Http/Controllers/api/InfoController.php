<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;

class InfoController extends Controller
{
    public function getBooksByAuthorName(string $name): \Illuminate\Http\JsonResponse
    {
        $books = Author::where('name', $name)->with('books')->first()->books;
        if ($books->isEmpty()) {
            return response()->json([
                'success' => false,
                'error' => 'no such user|no books on this user'
            ]);
        }

        return response()->json([
            'success' => true,
            // there can be a resource if some data is confidential
            'books' => $books,
        ]);
    }

    public function getBooksById(int $id): \Illuminate\Http\JsonResponse
    {
        $book = Book::where('id', $id)->first();
        if (empty($book)) {
            return response()->json([
                'success' => false,
                'error' => 'no such book'
            ]);
        }

        return response()->json([
            'success' => true,
            // there can be a resource if some data is confidential
            'book' => $book,
        ]);
    }
}
