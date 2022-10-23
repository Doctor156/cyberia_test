@extends('template')
@section('content')
@auth()
    <form class="container" enctype="multipart/form-data" action="{{ route('login') }}" method="POST">
        @csrf
        <label>
            Почта
            <input id="email" name="email" type="text"  class="email">
        </label>
        <label>
            Пароль
            <input id="password" name="password" type="text" class="password">
        </label>
        <button type="submit">Отправить</button>
    </form>
@endauth
@endsection
