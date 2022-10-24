@extends('template')
@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                @foreach(array_keys($data[0]) as $key)
                    <th>{{$key}}</th>
                @endforeach
            </tr>
        </thead>
   @foreach($data as $resource)
        <tr>
            @foreach($resource as $element)
                <td>{{$element}}</td>
            @endforeach
                <td>
                    <form method="post" action="{{ route($deleteRouteName, $resource['id']) }}">
                        @csrf
                        <input type="submit" name="submit" value="delete">
                    </form>
                </td>
        </tr>
   @endforeach
    </table>
@endsection
