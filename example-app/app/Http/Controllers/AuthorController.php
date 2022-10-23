<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Get resource list.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index()
    {
        return view('admin.list')->with('data', AuthorResource::collection(Author::with('books')->get()->all())->toArray(request()));
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
    public function store(AuthRequest $request)
    {
        //
    }

    /**
     * Get resource editing page.
     *
     * @param  \App\Models\Author  $author
     * @return Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return Response
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
