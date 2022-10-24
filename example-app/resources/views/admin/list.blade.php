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
            @foreach($resource as $key => $element)
                @if($key === 'delete route')
                    <td>
                        <form method="post" action="{{ $element }}">
                            @csrf
                            <input type="submit" name="submit" value="delete">
                        </form>
                    </td>
                @else
                <td>{{$element}}</td>
                @endif
            @endforeach
        </tr>
   @endforeach
    </table>
@endsection
