<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Get resource list.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index()
    {
        return view('admin.list', [
            'data' => BookResource::collection(Book::with('author', 'genres')->get()->all())->toArray(request())]);
    }

    /**
     * Get resource making page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();

        return view('admin.edit.book', [
            'action' => route('store.book'),
            'authors' => $authors,
            'genres' => $genres,
            ]);
    }

    /**
     * Put resource in database.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book();
        $book->name = $request->getName();
        $book->author_id = $request->getAuthorId() ?? $book?->author->id;
        $book->save();

        if ($genres = $request->getGenres()) {
            $book->genres()->sync($genres);
        }

        return redirect()->route('edit.book', $book->id);
    }


    /**
     * Get resource editing page.
     *
     * @param Book $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();

        return view('admin.edit.book', [
            'book' => $book,
            'action' => route('update.book', $book->id),
            'authors' => $authors,
            'genres' => $genres,
            'booksGenres' => $book->genres->keyBy('id')]);
    }

    /**
     * Update resource and put in the storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->name = $request->getName();
        if (!empty($genres = $request->getGenres())) {
            $book->genres()->sync($genres);
        }

        if (!empty($author = $request->getAuthorId())) {
            $book->author_id = $author;
        }

        $book->save();
        return redirect()->back();
    }

    /**
     * Delete resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->back();
    }
}
