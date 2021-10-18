@extends('admin.index')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Токен чата</th>
            <th scope="col">id Автора</th>
            <th scope="col">Сообщение</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <th scope="row">{{$message->id}}</th>
                <td>{{$message->chat_id}}</td>
                <td>{{$message->author_id}}</td>
                <td>{{$message->content}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
