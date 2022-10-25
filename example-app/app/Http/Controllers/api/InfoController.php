<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\BookRequest;
use App\Http\Resources\AuthorWithBooksResource;
use App\Http\Response\ApiResponse;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    public function getBooksByAuthorName(string $name): \Illuminate\Http\JsonResponse
    {
        $books = Author::where('name', $name)->with('books')->first()?->books;
        if (empty($books) || $books->isEmpty()) {
            return response()->json( new ApiResponse(false, ['error' => 'no such author|no books on this author']));
        }

        return response()->json( new ApiResponse(true, $books->toArray()));
    }

    public function getBookById(Book $book): \Illuminate\Http\JsonResponse
    {
        return response()->json(new ApiResponse(true, $book->toArray()));
    }

    public function updateBookById(Book $book, BookRequest $request): \Illuminate\Http\JsonResponse
    {
        $book->name = $request->getName();

        if ($genres = $request->getGenres()) {
            $book->genres()->sync($genres);
        }
        $book->save();

        return response()->json(new ApiResponse(true, $book->toArray()));
    }

    public function deleteBookById(Book $book): \Illuminate\Http\JsonResponse
    {
        $book->delete();

        return response()->json(new ApiResponse(true));
    }

    /**
     * Returns author | number of author books list
     *
     * @return JsonResponse
     */
    public function getAuthorBooksCount(): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            new ApiResponse(true,
            AuthorWithBooksResource::collection(Author::with('books')->get()->all())->toArray(\request())));
    }

    public function getAuthorById(Author $author): \Illuminate\Http\JsonResponse
    {
        return response()->json(new ApiResponse(true, (new AuthorWithBooksResource($author))->toArray(\request())));
    }

    public function updateAuthor(AuthorRequest $request): \Illuminate\Http\JsonResponse
    {
        /** @var Author $author */
        $author = $request->user()->author;

        if ($name = $request->getName()) {
            $author->name = $name;
        }

        if ($userId = $request->getUserId()) {
            $author->user_id = $userId;
        }

        if ($books = $request->getBooks()) {
            // unbind old books
            $author->books()->update(['author_id' => null]);
            Book::whereIn('id', $books)->update(['author_id' => $author->id]);
        }

        $author->save();

        return response()->json(new ApiResponse(true, $author->toArray()));
    }
}
