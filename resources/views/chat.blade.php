@extends('index')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.2.0/socket.io.js"></script>
@section('content')
    <body style="background: url('https://mobimg.b-cdn.net/v3/fetch/8a/8a1566620007c54402b4b883e0878236.jpeg')">
    <div class="space" style="padding: 20px;border-radius:15px;border: 4px;border-color: #f00;background: #990066;margin-top: 50px; margin-left: 350px;margin-right: 350px;">
    <a type="button" href="{{route('index')}}" class="btn btn-light" style="float:left;" > Вернуться на главную страницу</a>
        <h3 style="color: #f7fafc">         <img src="http://localhost:8000/storage/{{$user->image}}" alt="mdo" width="50" height="50" style="border-radius: 10px;">
             {{$user->name}} {{$user->surname}}</h3>
    @if($user->chat()->find(Auth::user())->id)
            <input type="hidden" value="{{$user->chat()->find(Auth::user()->id)->pivot->chat_id}}" class="chat_id" name="chat_id" style="outline: none;border: none; ">
            <input type="hidden" value="{{Auth::user()->id}}" class="user_id" name="user_id" style="outline: none;border: none; ">
        <br>
        <br>
        <ul class="chat" style="margin-top:20px;">
            @if($userChats)
                @foreach($userChats as $userChat)
                    @if(Auth::user()->id == $userChat->author_id)
                        @if(substr($userChat->content,-4) == '.jpg')
                            <br>
                            <button type="button" data-toggle="modal" style="border-radius: 10px;float: left;background: transparent;
    border: none !important;" data-target="#imageModel" class="info" data-id="{{$userChat->id}}">
                                <img src="http://localhost:8000/storage/{{$userChat->content}}" style="border-radius: 10px;width:100px; height:100px;"  >
                            </button>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        @elseif(substr($userChat->content,-5) == '.docx' || substr($userChat->content,-5) == '.text')
                            <br>
                            <a type="button" class="btn btn-primary" href="http://localhost:8000/storage/{{$userChat->content}}" download="{{$userChat->content}}" style="float:left;">Файл {{substr($userChat->content,-5)}}</a>
                            <br>
                            <br>
                        @else
                        <button class="badge badge-pill badge-light mess" data-toggle="modal" data-target="#messModal" data-id="{{$userChat->id}}" style="color:#1a202c ;float:left;font-size:24px;border:none;">{{$userChat->content}}</button><br>
                        <br>
                        @endif
                    @else

                        @if(substr($userChat->content,-4) == '.jpg')
                            <br>
                            <button type="button" data-toggle="modal" style="border-radius: 10px;float: right;margin-right: 40px;background: transparent;
    border: none !important;" data-target="#imageModel" class="info" data-id="{{$userChat->id}}">
                                <img src="http://localhost:8000/storage/{{$userChat->content}}" alt="mdo" width="100" height="100" style="float: right;border-radius: 10px;">
                            </button>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        @elseif(substr($userChat->content,-5) == '.docx')
                            <br>
                            <a type="button" class="btn btn-primary" href="http://localhost:8000/storage/{{$userChat->content}}" download="{{$userChat->content}}" style="float: right">Файл {{substr($userChat->content,-5)}}</a>
                            <br>
                            <br>
                        @else
                        <button class="badge badge-pill badge-light"  style="color:#1a202c ;float:right;margin-right: 40px;font-size:24px;border:none;">{{$userChat->content}}</button><br>
                        <br>
                        @endif
                    @endif
                @endforeach
            @endif

            <br>
                <span class="badge badge-pill badge-light mess" style="color:#1a202c ;float:left;width:100px"></span><br>
        </ul>
    <hr>
    <form class="form">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#smileModal" style="float: left; height:37px;">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-emoji-smile" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path fill-rule="evenodd" d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683z"/>
                <path d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
            </svg>
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: left;margin-left: 5px;">
            Файл
        </button>
        <textarea name="content" class="form-control"  style="float:left;width:50%;height: 35px;margin-left: 5px;"></textarea>
        <button type="submit" class="btn btn-primary" style="float: left; margin-left: 5px;height: 37px;" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"></path>
            </svg></button>
        <br><br>
        <p style="float: left; color: white">Количество сообщений: {{$userChats->count()}}</p>
    </form>

    </div>
    @endif





    {{-- Отправка файла --}}
    <form action="{{route('chat.post')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Отправка файла</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input value="{{$user->chat()->find(Auth::user()->id)->pivot->chat_id}}" name="chat_id" style="outline: none;border: none; color: transparent">
                        <input value="{{Auth::user()->id}}" name="user_id" style="outline: none;border: none;color: transparent ">
                        <input type="file" name="image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="modal fade" id="imageModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width:0%;height: 0%;">
                    <div class="modal-body" >

                    </div>
                </div>
            </div>
        <input  type="hidden" id="messageId" value="" class="messageId" name="id" style="outline: none;border: none; ">
        <img class="image" style="object-fit: contain;width:680px;height: 680px;"><br>
        <button type="button" class="btn btn-danger deleteMess">Удалить</button>
        </div>

    {{-- Изменение сообщений--}}
    <div class="modal fade" id="messModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Сообщение</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="changeMess" method="POST" action="{{route('changeMess')}}">
                    @csrf
                <div class="modal-body">
                    <input  type="hidden" id="messageId" value="" class="messageId" name="id" style="outline: none;border: none; ">
                    <input value="" class="form-control message" name="message">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-outline-danger deleteMess">Удалить</button>
                    <button type="submit" class="btn btn-warning">Изменить</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="smileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="raw">
                        @foreach($smiles as $smile)
                            <div class="col-sm">
                                <button type="button" style="border-radius: 10px;float: right;margin-right: 40px;background: transparent;
    border: none !important;" class="send_smile" data-id="{{$smile->id}}">
                                    <img src="http://localhost:8000/storage/{{$smile->content}}" style="width: 150px; height: 150px;">
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
{{----------------------------------------------------------------------------------------------}}
    <script>
        let socket = new io.connect(':6001');

        function appendMessage(data){
            $('.chat').append(
                $('.mess').text(data.message)
            );
        }

        $('.form').on('submit',function (){
            let id = document.querySelector('.chat_id').value;
            let user_id = document.querySelector('.user_id').value;
            console.log(id);
            console.log(user_id);
            let text = $('textarea').val(),
                msg = {message : text};
            socket.send(msg);
            console.log(msg);
           //appendMessage(msg);
            $.ajax({
                url: 'http://localhost:8000/api/messages/',
                type: "POST",
                data: {'text' : text, 'user_id' : user_id, 'chat_id' : id},
                success: function (data) {
                    location.reload();
                }
            });
            $('textarea').val('');
            return false;
        });
        socket.on('message',function (data){
            appendMessage(data);
            console.log("client",data);
        });
        $(document).ready(function() {
            $('.info').click(function () {
                let id = $(this).data('id');
                console.log(id)
                $.ajax({
                    url: 'http://localhost:8000/api/image/' + id,
                    type: "GET",
                    success: function (data) {
                        console.log(data.content);
                        console.log(data.id);
                        document.querySelector('.messageId').value = data.id;
                        document.querySelector('.image').src = "/storage/" + data.content;
                    }
                });
            });
            $('.mess').click(function(){
                let id = $(this).data('id');
                console.log(id)
                $.ajax({
                    url: 'http://localhost:8000/api/image/' + id,
                    type: "GET",
                    success: function (data) {
                        console.log(data.content);
                        document.querySelector('.messageId').value = data.id;
                        document.querySelector('.message').value = data.content;
                    }
                });
            });
            $('.send_smile').click(function (){
               let id = $(this).data('id');
               console.log(id);
               let chat_id = document.querySelector('.chat_id').value;
               let user_id = document.querySelector('.user_id').value;
               console.log(chat_id);
               console.log(user_id);
               $.ajax({
                   url: 'http://localhost:8000/api/smile/messages/' + id,
                   type: "POST",
                   data: {'user_id' : user_id, 'chat_id' : chat_id},
                   success: function(data) {
                    location.reload();
                   }
               });
            });
            $('.deleteMess').click(function (){
               let id = document.getElementById('messageId').value
                console.log(id);
               $.ajax({
                   url: 'http://localhost:8000/api/delete_mess/' + id,
                   type: "POST",
                   success: function (data) {
                       location.reload();
                   }
               });
            });
        });

    </script>
{{-----------------------------------------------------------------------------------------------------------------}}
    </body>
@endsection
