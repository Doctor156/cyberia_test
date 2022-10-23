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
        </tr>
   @endforeach
    </table>
@endsection
