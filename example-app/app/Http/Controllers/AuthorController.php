<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Get resource list.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index()
    {
        return view('admin.list', ['data' => AuthorResource::collection(Author::with('books')->get()->all())->toArray(request())]);
    }

    /**
     * Get resource making page
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // One user can have one author relationship, but author is doesnt required in author
        // Example: if u wanna add Shakespeare's book, u dont need user. When ur a admin, ofc
        $freeUsers = User::with('author')->doesntHave('author')->get();

        return view('admin.edit.author', [
            'action' => route('store.author'),
            'users' => $freeUsers,
            'books' => Book::all(),
        ]);
    }

    /**
     * Put resource in database.
     *
     * @param AuthorRequest $request
     * @return RedirectResponse
     */
    public function store(AuthorRequest $request)
    {
        $author = new Author();
        $author->name = $request->getName();
        $author->user_id = $request->getUserId();
        $author->save();

        if ($books = $request->getBooks()) {
            $author->books()->saveMany($books);
        }

        return redirect()->route('edit.author', $author->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Author $author)
    {
        $freeUsers = User::with('author')->doesntHave('author')->get();
        return view('admin.edit.author', [
            'author' => $author,
            'action' => route('edit.author', $author->id),
            'users' => $freeUsers,
            'books' => $books = Book::all(),
            'authorBooks' => $books->keyBy('author_id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $author->name = $request->getName();
        $author->user_id = $request->getUserId();
        $author->save();

        if ($books = $request->getBooks()) {
            // unbind old books
            $author->books()->update(['author_id' => null]);
            Book::whereIn('id', $books)->update(['author_id' => $author->id]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return RedirectResponse
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->back();
    }
}
