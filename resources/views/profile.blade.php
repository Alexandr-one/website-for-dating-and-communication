@extends('index')

@section('content')

    <style>
        hr {
            border: none;
            border-top: 6px double white;
            color: white;
            overflow: visible;
            text-align: center;
        }
    </style>
    <div  style="background:url('https://phonoteka.org/uploads/posts/2021-05/1620122691_54-phonoteka_org-p-fioletovii-fon-dlya-autro-62.jpg')">
     @if($changeMess)
           <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ $changeMess  }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
                </div>

            @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div>
            <div>
                <div>
                    <div id="about">
                        <img src="storage/{{Auth::user()->image}}" alt="mdo" width="300" height="300" class="rounded-circle">
                        <h3 class="media-heading text-light">{{Auth::user()->name}} {{Auth::user()->surname}}<small><br> {{Auth::user()->country}}, {{Auth::user()->town}}</small></h3>
                        <a type="button" class="btn btn-outline-light" href="{{route('index')}}">На главную страницу</a><br><br>
                        @if(Auth::user()->chat()->count() != 0)
                            <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#chatModel">
                                Перейти к чатам
                            </button>
                        @endif
                        @if(Auth::user()->status == 'ADMIN')
                            <a type="button" class="btn btn-outline-light" href="{{route('admin')}}">Админ панель</a>
                        @endif
                        <hr>
                        <center>
                            <p class="text-center text-light "><strong>Информация: </strong><br>
                                {{Auth::user()->surname}} {{Auth::user()->name}} {{Auth::user()->patronymic}} <br>
                                Дата рождения: {{Auth::user()->date_of_birth}} <br>
                                Пол: {{Auth::user()->sex}} <br>
                                Страна: {{Auth::user()->country}} <br>
                                Город: {{Auth::user()->town}} <br>
                                Описание: {{Auth::user()->description}}<br><br>
                                Лайков: {{Auth::user()->liked()->count()}}<br>
                                Знак зодиака: {{Auth::user()->zodiac[0]->name}}
                            </p>

                            <br>
                            <button type="button" class="btn btn-outline-light"style="margin-top: 10px;" data-toggle="modal" data-target="#exampleModal">
                                Изменить
                            </button>
                            <br>
                            <br>
                            <br>
                            <br>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="chatModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Чаты пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach(Auth::user()->chat as $userChat)
                        <button class="btn btn-warning"  style="border-radius: 50px;">
                            {{\App\Models\Message::where('chat_id','=',$userChat->pivot->chat_id)->where('status','=','new')->where('author_id','!=',Auth::user()->id)->get()->count()}}
                        </button>
                        <a type="button" href="/index/chat/{{$userChat->id}}" style=" margin-left: 5px;background-color: #990066; border:none;" class="btn btn-sm btn-primary chating" >Перейти к чату c {{\App\Models\User::find($userChat->id)->name}} {{\App\Models\User::find($userChat->id)->surname}}</a> <br><br>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изменить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <form method="POST" action="{{route('change')}}" enctype="multipart/form-data">
                    @csrf
                        <div style="">
                            <span>Имя</span>
                            <input type="name" name="name" class="form-control" style="margin-top:10px;" value="{{Auth::user()->name}}"> <br>
                            <span>Фамилия</span>
                            <input class="form-control" name="surname" style="margin-top:10px;" placeholder="Фамилия" value="{{Auth::user()->surname}}"> <br>
                            <span>Email</span>
                            <input class="form-control" type="email" name="email" style="margin-top:10px;" placeholder="Email" value="{{Auth::user()->email}}"> <br>
                            <span>Страна</span>
                            <input class="form-control" type="text" name="country" style="margin-top:10px;" placeholder="Страна" value="{{Auth::user()->country}}"> <br>
                            <span>Город</span>
                            <input name="town" class="form-control" style="margin-top:10px;" placeholder="Город" value="{{Auth::user()->town}}"> <br>
                            <span>Описание</span>
                            <textarea name="description" style="margin-top:10px;" class="form-control">{{Auth::user()->description}}</textarea>
                        </div>
                        <span>Аватар</span>
                        <input name="image" type="file" class="form-control" style="margin-top:10px;">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-outline-success">Сохранить</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
