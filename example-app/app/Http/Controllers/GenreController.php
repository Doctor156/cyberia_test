<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Contracts\Foundation\Application;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.list', ['data' => GenreResource::collection(Genre::get()->all())->toArray(request())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.edit.genre', [
            'action' => route('store.genre'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GenreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GenreRequest $request)
    {
        $genre = new Genre();
        $genre->name = $request->getName();
        $genre->save();

        return redirect()->route('edit.genre', $genre->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Genre $genre)
    {
        return view('admin.edit.genre', [
            'action' => route('update.genre', $genre->id),
            'genre' => $genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGenreRequest  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->name = $request->getName();
        $genre->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->back();
    }
}
