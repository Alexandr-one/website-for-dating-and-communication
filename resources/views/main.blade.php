@extends('index')

@section('content')
    <body class="text-center" style="background:url('https://phonoteka.org/uploads/posts/2021-05/1620122691_54-phonoteka_org-p-fioletovii-fon-dlya-autro-62.jpg')">
        <header class="py-3 border-bottom" style="background-color: #990066" >
            <div class="container-fluid d-grid gap-3 align-items-center" style=" grid-template-columns: 1fr 2fr;">
                <p style="float: left; color: white;font-size: 20px;margin-top: 20px;">Сайт знакомств Dating <img style="width: 40px; height: 40px;border-radius: 10px;" src="https://yt3.ggpht.com/a/AATXAJxSrEdYyrQsVZ4xIBhS_P4xoVxAW8sTqsePmsV4=s900-c-k-c0x00ffffff-no-rj"></p>
                <div class="d-flex">
                    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#filterModal">
                        Фильтр
                    </button>
                    <form class="w-100 me-3 form-inline" style="margin-left: 10px; " action="{{route('index')}}">
                        <input type="search " name='nameFilled' value="{{ \Request::get('nameFilled') }}" class="form-control" placeholder="Имя" aria-label="Search" style="width: 200px;">
                        <input type="search " name='surnameFilled' value="{{ $getPar }}" class="form-control" placeholder="Фамилия" aria-label="Search" style="width: 200px; margin-left: 10px;">
                        <button type="submit" style="margin-left: 5px;" class="btn btn-outline-light">Поиск</button>
                        <a type="button" class="btn btn-outline-light" style="margin-left: 5px;" href="{{route('index')}}">Сбросить</a>
                    </form>
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="storage/{{Auth::user()->image}}" alt="mdo" width="40" height="40" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="/profile">Профиль</a></li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                            <li><hr class="dropdown-divider"><button type="submit" class="dropdown-item">Выйти</button></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div>
            @if($message)
                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-left: 60px;margin-right: 960px; height: 70px;margin-top: 10px;">
                    <p style="color: black"> {{ $message  }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                        <span aria-hidden="true" style="color: black">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div>
            <div class="row" style="margin-left:50px;margin-right:50px;">
                @foreach($users as $user)
                    <div class="col-md-3" style="margin-top: 30px;" >
                        <div class="card mb-4 box-shadow" style="border-radius: 20px;box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                            <div class="card-body" >
                                <button type="button" data-toggle="modal" style="border-radius: 10px;background: transparent;
        border: none !important;" data-target="#imageModel" class="imageInfo" data-id="{{$user->id}}">
                                    <img src="storage/{{$user->image}}" alt="mdo" width="260" height="240" style="border-radius: 20px;box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                                </button><br>
                                <p class="card-text" style="margin-top: 25px;">{{$user->name}} {{$user->surname}}</p>
                                <p class="card-text">{{$user->country}}, {{$user->town}}</p>
                                <p class="card-text">{{$user->sex}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        @if($user->liked()->find(Auth::user()->id))
                                            <button type="button" data-id="[{{$user->id}},{{Auth::user()->id}}]" class="btn btn-outline-danger delike">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                                {{$user->liked()->count()}}
                                            </button>
                                        @else
                                            <button type="button" data-id="[{{$user->id}},{{Auth::user()->id}}]" class="btn btn-outline-success like">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                                {{$user->liked()->count()}}
                                            </button>
                                        @endif
                                        @if($user->chat()->find(Auth::user()->id) && Auth::user()->id != $user->id)
                                            @if(Auth::user()->chat()->find($user->id)->pivot->status == \App\Classes\ChatUserStatusEnum::DELETE)
                                                <form method="POST" action="{{route('recoverChat')}}">
                                                    @csrf
                                                    <input type="hidden"  style="outline: none;border: none; color: transparent" name="user_id" value="{{Auth::user()->id}}">
                                                    <input type="hidden" style="outline: none;border: none; color: transparent" name="sec_user_id" value="{{$user->id}}">
                                                    <button type="submit" class="btn btn-outline-danger" style="margin-left: 10px;">Восстановить</button>
                                                </form>
                                            @else
                                                <a type="button" href="/index/chat/{{$user->id}}" style="width:170px; margin-left: 5px;" class="btn btn-sm btn-outline-dark">Перейти к чату</a>
                                            @endif
                                        @else
                                            @if(Auth::user()->id != $user->id)
                                                <button style="margin-left:5px;" class="btn btn-sm btn-outline-dark info" data-id="{{$user->id}}" data-toggle="modal"  data-target="#exampleModalLong">Подробная информация</button>
                                            @else
                                                <a type="button" href="{{route('profile')}}" style="margin-left: 5px;" class="btn btn-sm btn-outline-dark" >Профиль</a>
                                            @endif
                                        @endif
                                    </div>
                                    <small class="text-muted">{{$user->age}} лет</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div style="margin-top:10px;">
                    {{ $users->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
        {{-- Модалка для фильтра --}}
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Фильтр</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('index')}}">
                            <select name="filter" class="form-control">
                                <option value='asc'
                                        @if($selPar == "asc")
                                        selected=""
                                    @endif >
                                    Возраст по возрастанию
                                </option>
                                <option value='desc'
                                        @if($selPar == "desc")
                                        selected=""
                                    @endif >
                                    Возраст по убыванию
                                    </option>
                                </select><br>
                            <input name='min_age' class="form-control" value="{{ $getAgeMinPar }}" style=" margin-top:10px;" placeholder="Минимальный возраст">
                            <input name='max_age' class="form-control" value="{{ $getAgeMaxPar }}" style=" margin-top:10px;" placeholder="Максимальный возраст"><br>
                            <input name="town" class="form-control" value="{{$getTown}}" style=" margin-top:10px;" placeholder="Введите город">
                            <input name="country" class="form-control" value="{{$getCountry}}"  style=" margin-top:10px; " placeholder="Введите страну"><br>
                            <input name='sex' class="form-control" value="{{ $getSex }}" placeholder="Введите пол" style="margin-top:10px;"><br>
                            <div class="modal-footer" style="margin-top:10px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-success">Поиск</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Модалка для изображения --}}
        <div class="modal fade" id="imageModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width:0%;height: 0%;">
                </div>
            </div>
            <img class="img" style="object-fit: contain;width:680px;height: 680px;">
        </div>

        {{-- Модалка для анкеты --}}
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <img class="card-img-top image" src="storage/" style="height: 50%; width: 50%; display: block; float: right; padding-left: 10px; padding-bottom: 10px;" >
                        <div class="raw">
                            <input type="text"  value="" class="form-control surname" style="float:left;width:50%;margin-top: 2px;">
                            <input type="text"  value="" class="form-control name" style="float:left;width:50%;margin-top: 2px;">
                            <input type="text"  value="" class="form-control sex" style="float:left;width:50%;margin-top: 2px;">
                            <input type="text"  value="" class="form-control date_of_birth" style="float:left;width:50%;margin-top: 2px;">
                            <input type="text" value="" class="form-control country" style="float:left;width:50%;margin-top: 2px;">
                            <input type="text"  value="" class="form-control town" style= "float:left;width:50%;margin-top: 2px;"><br>
                            <textarea class="form-control description" style="float:left;width:50%;margin-top: 20px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success createChat" data-id="{{Auth::user()->id}}">Написать</button>
                        <input type="hidden" value="" class="user_id" name="user_id" style="outline: none;border: none; ">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

    </body>

    <script>
        $(document).ready(function(){
            $('.info').click(function(){
                let id = $(this).data('id');
                console.log(id)
                $.ajax({
                    url: 'http://localhost:8000/api/users/' + id,
                    type: "GET",
                    success: function (data) {
                        console.log(data.name)
                        document.querySelector('.user_id').value = data.id;
                        document.querySelector('.image').src = "/storage/" + data.image;
                        document.querySelector('.name').value = data.name;
                        document.querySelector('.surname').value = data.surname;
                        document.querySelector('.sex').value = data.sex;
                        document.querySelector('.date_of_birth').value = data.date_of_birth;
                        document.querySelector('.country').value = data.country;
                        document.querySelector('.town').value = data.town;
                        document.querySelector('.description').textContent = data.description;
                    }
                });
            });
            $('.like').click(function (){
                let id = $(this).data('id');
                console.log(id)
                $.ajax({
                    url: 'http://localhost:8000/api/like/' + id[0] + '/' + id[1],
                    type: "GET",
                    success: function (data) {
                        console.log(data.name);
                        //document.querySelector('.like_count').value = data;
                        location.reload();
                    }
                });
            });
            $('.imageInfo').click(function () {
                let id = $(this).data('id');
                console.log(id)
                $.ajax({
                    url: 'http://localhost:8000/api/get_image/' + id,
                    type: "GET",
                    success: function (data) {
                        console.log(data.content);
                        document.querySelector('.img').src = "/storage/" + data.image;
                    }
                });
            });

            $('.createChat').click(function (){
                let id = $(this).data('id');//4
                let user_id = document.querySelector('.user_id').value;//3
                console.log(id);
                console.log(user_id);
                $.ajax({
                    url: 'http://localhost:8000/api/index/create/chat/',
                    type: "POST",
                    data: {'user_id' : id, 'users_id' : user_id},
                    success: function (data) {
                        location.assign('http://localhost:8000/index/chat/'+user_id);
                    }
                });
            });
            $('.delike').click(function (){
                let id = $(this).data('id');
                console.log(id)
                $.ajax({
                    url: 'http://localhost:8000/api/delike/' + id[0] + '/' + id[1],
                    type: "GET",
                    success: function (data) {
                        console.log(data.name);
                        //document.querySelector('.like_count').value = data;
                        location.reload();
                    }
                });
            });
        });

    </script>
@endsection
