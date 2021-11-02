@extends('admin.index')

@section('content')
    <form class="w-100 me-3 form-inline" style="margin-left: 10px; " action="{{route('chats')}}">
        <button type="button" class="btn btn-primary" data-toggle="modal" style="background-color: #990066;border-color: #990066" data-target="#exampleModalCenter">
            Удалить
        </button>
        <input type="text" name='chat_id' class="form-control" value="{{$getPar}}" placeholder="Токен чата" aria-label="Search" style="width: 200px;margin-left: 10px;">
        <button type="submit" style="margin-left: 5px;background-color: #990066" class="btn btn-outline-light" >Поиск</button>
        <a type="button" class="btn btn-outline-light" style="margin-left: 5px;background-color:#990066" href="{{route('chats')}}">Сбросить</a>
    </form>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">id Чата</th>
            <th scope="col">Первый пользователя</th>
            <th scope="col">Второй пользователя</th>
            <th scope="col">Количество сообщений</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chats as $chat)
            @foreach($chat->firstUser as $firstUser)
                @foreach($chat->secondUser as $secondUser)
            <tr>
                <th scope="row">{{$chat->id}}</th>
                <td>{{$chat->chat_id}}</td>
                <td>{{$firstUser->id}} {{$firstUser->name}} {{$firstUser->surname}}</td>
                <td>{{$secondUser->id}} {{$secondUser->name}} {{$secondUser->surname}}</td>
                <td><a href="http://localhost:8000/admin/messages?chat_id={{$chat->chat_id}}">{{$chat->message()->count()}}</a></td>
                <td>{{$chat->status}}</td>
            </tr>
                    @endforeach
                @endforeach
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Удаление чата</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('deleteAdminChat')}}" method="POST">
                    @csrf
                <div class="modal-body">
                    <input type="text" name="first_id" placeholder="Введите id пользователя" class="form-control">
                    <input type="text" name="second_id" placeholder="Введите id пользователя" class="form-control" style="margin-top: 10px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
