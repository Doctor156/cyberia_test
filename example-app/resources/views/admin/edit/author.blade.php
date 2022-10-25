@extends('template')
@section('content')
    <form class="container" enctype="multipart/form-data" action="{{ $action }}" method="POST">
        @csrf
        <label>
            Псевдоним
            <input id="name" value="{{isset($author) ? $author?->name : ''}}" name="name" type="text" class="name">
        </label>
        <label>
            Выбор аккаунта пользователя:
            <select name="user_id">
                <option value="">Не выбран</option>
                @if(isset($author) && isset($author->user))<option selected value="{{$author->user->id}}">{{$author->user->name}}</option> @endif
                @foreach($users as $user)
                    <option @if(isset($author, $author->user)  && $author?->user->id === $user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </label>
        <label>
            Книги
            @foreach($books as $book)
                <span class="book-name">{{$book->name}}</span>
                <input @if(isset($author, $book->author) && $book->author->id === $author->id) checked @endif value="{{$book->id}}" name="books[]"
                       type="checkbox" class="book">
            @endforeach
        </label>
        <button type="submit">Cохранить</button>
    </form>
@endsection
