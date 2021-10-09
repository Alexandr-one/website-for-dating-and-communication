@extends('index')

@section('content')
    @if($message)
    <div class="alert alert-success" role="alert">
     {{ $message  }}
    </div>
    @endif
    <button type="button" class="btn btn-primary ml-3" data-bs-toggle="modal" data-bs-target="#sendModel" data-bs-whatever="@mdo">Отправить</button>

    <body class="text-center" >
    <header class="  py-3 border-bottom"style="background:url('https://phonoteka.org/uploads/posts/2021-05/1620122691_54-phonoteka_org-p-fioletovii-fon-dlya-autro-62.jpg')" >
        <div class="container-fluid d-grid gap-3 align-items-center" style=" grid-template-columns: 1fr 2fr;">
            <div class="dropdown">
                <a type="button" class="btn btn-outline-light" href="{{route('homepage')}}" >На форму регистрации</a>

            </div>
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
                        <Form action="{{ route('logout') }}" method="POST">
                            @csrf
                        <li><hr class="dropdown-divider"><button type="submit" class="dropdown-item">Выйти</button></li>
                        </Form>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid pb-3" style="background:url('https://phonoteka.org/uploads/posts/2021-05/1620122691_54-phonoteka_org-p-fioletovii-fon-dlya-autro-62.jpg')">
        <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;" >
            <div class="bg-light" style="height: 807px; margin-top: 10px;border-radius: 20px;">
                <img src="https://yt3.ggpht.com/a/AGF-l78t8lDIFTi-iEMpBV70obgLwgkceqDOTQKO-A=s900-c-k-c0xffffffff-no-rj-mo" style="width:250px; height: 250px;border-radius: 20px 40px; margin-left:auto; margin-right: auto; margin-top: 20px;">
                <br>
                <p style="color:black;margin-top:20px;font-size: 20px;margin-left: 20px; margin-right: 20px;">На нашем сайте знакомств вы можете общаться и знакомиться с интересными людьми со всего мира.
                    Все фотографии и тексты проходят ручную модерацию. Видео анкеты и голосовые приветствия позволят вам проявить себя и лучше узнать других. Будьте уверены - мы делаем все, чтобы у нас вы общались с настоящими людьми для реальных знакомств.
                    Что бы вы ни искали - общение, флирт, любовь - вы пришли на правильный сайт. Удачи!</p>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="https://www.savushkin.by/"><img src="storage\uploads\Снимок.PNG" style="margin-top:20px;margin-left:20px;margin-right:20px;width:200px; height: 120px; border-radius: 20px 40px;"></a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.sberbank.ru/ru/person"><img src="storage\uploads\spr.jpg" style="margin-top:20px; margin-left:76px;width:200px; height: 120px; border-radius: 20px 40px;"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px;">
                <div class="row">
                    @foreach($users as $user)
                        <div class="col-md-4" >
                        <div class="card mb-4 box-shadow" style="border-radius: 20px;">
                            <div class="card-body" >
                                <img src="storage/{{$user->image}}" alt="mdo" width="200" height="200" class="rounded-circle">
                                <p class="card-text">{{$user->name}} {{$user->surname}}</p>
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
                                            @if($user->chat()->find(Auth::user()->id))
                                                <a type="button" href="/index/chat/{{$user->id}}" style="width:170px; margin-left: 5px;" class="btn btn-sm btn-outline-dark chating" >Перейти к чату</a>
                                            @else
                                                <button style="margin-left:5px;" class="btn btn-sm btn-outline-dark info" data-id="{{$user->id}}" data-toggle="modal"  data-target="#exampleModalLong">Подробная информация</button>
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
                                         <input type="text" value="" class="surname" style="outline: none;border: none; ">
                                         <input type="text" value="" class="name" style="outline: none;border: none; ">
                                         <input type="text" value="" class="patronymic" style="outline: none;border: none; ">
                                            <input type="text" value="" class="sex" style="outline: none;width:175px;border: none;">
                                            <input type="text" value="" class="date_of_birth" style="outline: none;border: none; ">
                                        <input type="text" value="" class="country" style="outline: none;border: none; ">
                                        <input type="text" value="" class="town" style="outline: none;border: none; ">
                                            <input type="text" value="" class="description" style="outline: none;border: none; ">
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
                </div>

            </div>
        </div>
        <div>

        </div>
    </div>
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
                        <select name="filter">
                            <option value='asc'
                                    @if($selPar == "asc")
                                    selected=""
                                @endif >
                                По возрастанию
                            </option>
                            <option value='desc'
                                    @if($selPar == "desc")
                                    selected=""
                                @endif >
                                По убыванию
                            </option>
                        </select>
                        <br>
                        <input name='min_age' value="{{ $getAgeMinPar }}" style="width: 180px; margin-top:10px;" placeholder="Минимальный возраст">
                        <input name='max_age' value="{{ $getAgeMaxPar }}" style="width: 180px; margin-top:10px;margin-left: 10px"placeholder="Максимальный возраст">
                        <br>
                        <input name="town" value="{{$getTown}}" style="width: 180px; margin-top:10px;" placeholder="Введите город">
                        <input name="country" value="{{$getCountry}}"  style="width: 180px; margin-top:10px; margin-left:10px;" placeholder="Введите страну"><br>
                        <input name='sex' value="{{ $getSex }}" placeholder="Введите пол" style="margin-top:10px;"><br>

                        <div class="modal-footer" style="margin-top:10px;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Поиск</button>
                        </div>
                    </form>
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
                        document.querySelector('.patronymic').value = data.patronymic;
                        document.querySelector('.sex').value = data.sex;
                        document.querySelector('.date_of_birth').value = data.date_of_birth;
                        document.querySelector('.country').value = data.country;
                        document.querySelector('.town').value = data.town;
                        document.querySelector('.description').value = data.description;
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
    <div class="modal fade" id="sendModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Отправка</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="send" class='ml-3'>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table>
                            <thead>
                            <tr>
                                <th>
                                    <input name='sendName' placeholder="Ваше имя" />
                                </th>
                                <th>
                                    <input name='sendEmail' placeholder="Почта" />
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>
                                    <input name='sendTitle' type='text' placeholder="Тема сообщения" />
                                </th>
                                <th>
                                    <textarea name='sendText' type='text' placeholder="Текст"></textarea>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                        <td colspan='2'></td>
                        <div class="modal-footer">
                            <tr>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type='submit' class="btn btn-primary">отправить</button>
                            </tr>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
