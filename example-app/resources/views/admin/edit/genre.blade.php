@extends('template')
@section('content')
    <form class="container" enctype="multipart/form-data" action="{{ $action }}" method="POST">
        @csrf
        <label>
            Название
            <input id="name" value="{{isset($genre) ? $genre?->name : ''}}" name="name" type="text" class="genre">
        </label>
        <button type="submit">Cохранить</button>
    </form>
@endsection
