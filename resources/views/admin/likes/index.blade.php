@extends('admin.index')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">id Лайкнутого пользователя</th>
            <th scope="col">id Лайкнувшего пользователя</th>
        </tr>
        </thead>
        <tbody>
        @foreach($likes as $like)
            @foreach($like->firstUser as $firstUser)
                @foreach($like->secondUser as $secondUser)
            <tr>
                <th scope="row">{{$like->id}}</th>
                <td>{{$firstUser->name}} {{$firstUser->surname}}</td>
                <td>{{$secondUser->name}} {{$secondUser->surname }}</td>
            </tr>
                    @endforeach
                @endforeach
        @endforeach
        </tbody>
    </table>

@endsection
