@extends('template')
@section('content')
    @if(!isset($action))
        Ты как сюда попал вообще?
    @endif
    <form class="container" enctype="multipart/form-data" action="{{ $action }}" method="POST">
        @csrf
        <label>
            Название
            <input id="name" value="{{isset($book) ? $book?->name : ''}}" name="name" type="text" class="email">
        </label>
        <label>
            Жанры
            @foreach($genres as $genre)
                <span class="genre-name">{{$genre->name}}</span>
                <input @if(isset($booksGenres[$genre->id])) checked @endif value="{{$genre->id}}" name="genres[]"
                       type="checkbox" class="genre">
            @endforeach
        </label>
        <label>
            Автор
            <select name="author">
                @foreach($authors as $author)
                    <option @if(isset($book) && $author->id === $book?->author->id) selected @endif value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
            </select>
        </label>
        <button type="submit">Cохранить</button>
    </form>
@endsection
