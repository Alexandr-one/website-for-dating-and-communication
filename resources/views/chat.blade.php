@extends('index')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.2.0/socket.io.js"></script>
@section('content')
    <style>
        body {
            background: url('http://localhost:8000/storage/uploads/fone.mp4');
            background-size: cover;
        }

        .bgvideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -9999;
        }</style>
    <body style="">
    <video autoplay loop muted class="bgvideo" id="bgvideo">
        <source src="http://localhost:8000/storage/uploads/fone.mp4" type="video/mp4"></source>
    </video>
    <div class="space" style="padding: 20px;border-radius:15px;border: 4px;border-color: #f00;background: #E5D3BD;margin-top: 50px; margin-left: 350px;margin-right: 350px;background:url('https://phonoteka.org/uploads/posts/2021-05/1620122691_54-phonoteka_org-p-fioletovii-fon-dlya-autro-62.jpg')">
    <a type="button" href="{{route('index')}}" class="btn btn-light" style="float:left;" > Вернуться на главную страницу</a>
        <h3 style="color: #f7fafc">{{$user->name}}</h3>
    @if($user->chat()->find(Auth::user())->id)
            <input type="hidden" value="{{$user->chat()->find(Auth::user()->id)->pivot->chat_id}}" class="chat_id" name="chat_id" style="outline: none;border: none; ">
            <input type="hidden" value="{{Auth::user()->id}}" class="user_id" name="user_id" style="outline: none;border: none; ">
        <br>
        <br>
        <ul class="chat" style="margin-top:20px;">
            @if($userChats)
                @foreach($userChats as $userChat)
                    @if(Auth::user()->id == $userChat->author_id)
                        @if(substr($userChat->content,0,8) == 'uploads/')
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
                        @else
                        <span class="badge badge-pill badge-light" style="color:#1a202c ;float:left;width:100px;">{{$userChat->content}}</span><br>
                        @endif
                    @else
                        @if(substr($userChat->content,0,8) == 'uploads/')
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
                        @else
                        <span class="badge badge-pill badge-light" style="color:#1a202c ;float:right;width:100px;margin-right: 40px;">{{$userChat->content}}</span><br>
                        @endif
                    @endif
                @endforeach
            @endif

            <br>
                <span class="badge badge-pill badge-light mess" style="color:#1a202c ;float:left;width:100px"></span><br>
        </ul>
    <hr>
    <form>
        <textarea name="content" style="float:left;width:50%;height: 35px;"></textarea>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Изображение
        </button>
        <button type="submit"  style="float: right; margin-left: 5px; margin-top: 2px;" > <svg xmlns="http://www.w3.org/2000/svg"  width="25" height="25" fill="currentColor" class="bi bi-symmetry-horizontal" viewBox="0 0 16 16">
                <path d="M13.5 7a.5.5 0 0 0 .24-.939l-11-6A.5.5 0 0 0 2 .5v6a.5.5 0 0 0 .5.5h11zm.485 2.376a.5.5 0 0 1-.246.563l-11 6A.5.5 0 0 1 2 15.5v-6a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .485.376zM11.539 10H3v4.658L11.54 10z"/>
            </svg></button>
        <br>
    </form>

    <script>
        let socket = new io.connect(':6001');

        function appendMessage(data){
            $('.chat').append(
                $('.mess').text(data.message)
            );
        }

        $('form').on('submit',function (){
            let id = document.querySelector('.chat_id').value;
            let user_id = document.querySelector('.user_id').value;
            console.log(id);
            console.log(user_id);
            let text = $('textarea').val(),
                msg = {message : text};
            socket.send(msg);
            console.log(msg);
            appendMessage(msg);
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
                        document.querySelector('.image').src = "/storage/" + data.content;
                    }
                });
            });
        });

    </script>
    </div>
    @endif
    <form action="{{route('chat.post')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="imageModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width:0%;height: 0%;">
                    <div class="modal-body" >

                    </div>
                </div>
            </div>
            <img class="image" style="object-fit: contain;width:680px;height: 680px;">
        </div>
    </form>
    </body>
@endsection