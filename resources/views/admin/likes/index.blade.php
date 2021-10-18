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
            <tr>
                <th scope="row">{{$like->id}}</th>
                <td>{{$like->user_compliment_id}}</td>
                <td>{{$like->user_liked_id}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
