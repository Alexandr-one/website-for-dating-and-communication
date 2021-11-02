@extends('admin.index')

@section('content')
    <form class="w-100 me-3 form-inline" style="margin-left: 10px; " action="{{route('messages')}}">
        <input type="text" name='chat_id' class="form-control" value="{{$getPar}}" placeholder="Токен чата" aria-label="Search" style="width: 200px;">
        <button type="submit" style="margin-left: 5px;background-color: #990066" class="btn btn-outline-light" >Поиск</button>
        <a type="button" class="btn btn-outline-light" style="margin-left: 5px;background-color:#990066" href="{{route('messages')}}">Сбросить</a>
    </form>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Токен чата</th>
            <th scope="col">Автор</th>
            <th scope="col">Сообщение</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            @foreach($message->user as $user)
            <tr>
                <th scope="row">{{$message->id}}</th>
                <td><a href="http://localhost:8000/admin/chats?chat_id={{$message->chat_id}}">{{$message->chat_id}}</a></td>
                <td>{{$user->name}} {{$user->surname}}</td>
                <td>{{$message->content}}</td>
            </tr>
                @endforeach
        @endforeach
        </tbody>
    </table>

@endsection
