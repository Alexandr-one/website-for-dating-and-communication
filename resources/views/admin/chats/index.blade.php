@extends('admin.index')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">id Чата</th>
            <th scope="col">id Первого пользователя</th>
            <th scope="col">id Второго пользователя</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chats as $chat)
            <tr>
                <th scope="row">{{$chat->id}}</th>
                <td>{{$chat->chat_id}}</td>
                <td>{{$chat->user_first}}</td>
                <td>{{$chat->user_second}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
