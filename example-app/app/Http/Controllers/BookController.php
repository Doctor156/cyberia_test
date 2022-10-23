<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
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
        return view('admin.list')->with('data', BookResource::collection(Book::with('author', 'genres')->get()->all())->toArray(request()));
    }

    /**
     * Get resource making page
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Put resource in database.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return Response
     */
    public function store(StoreBookRequest $request)
    {
        //
    }


    /**
     * Get resource editing page.
     *
     * @param Book $book
     * @return Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update resource and put in the storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Delete resource.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
