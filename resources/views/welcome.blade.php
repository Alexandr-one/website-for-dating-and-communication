@extends('index')

@section('content')
<style>body {
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
    }</style></style>
    @if($loginError)
        <div class="alert alert-danger">
        <ul>
            {{$loginError}}
        </ul>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<body>

<video autoplay loop muted class="bgvideo" id="bgvideo">
    <source src="http://localhost:8000/storage/uploads/fone.mp4" type="video/mp4"></source>
</video>
<div class="space" style="background:url('https://phonoteka.org/uploads/posts/2021-05/1620122691_54-phonoteka_org-p-fioletovii-fon-dlya-autro-62.jpg');padding: 20px;border-radius:15px;border: 4px;border-color: #f00;margin-top: 20px; margin-left: 200px;margin-right: 200px;">
        <img src="https://yt3.ggpht.com/a/AGF-l78t8lDIFTi-iEMpBV70obgLwgkceqDOTQKO-A=s900-c-k-c0xffffffff-no-rj-mo" style="width:125px; height: 125px;border-radius: 20px 40px; margin-left:auto; margin-right: auto;">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

            </ul>
            <style>
                .line {
                    border-bottom: 3px solid white; /* Параметры линии */
                    margin-top: 10px;
                }
            </style>
                @if(Auth::user())
                    <a type="button" href="{{route("index")}}" class="btn btn-outline-light" >{{Auth::user()->name}}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light" style="margin-left:20px; ">Выйти</button>
                    </form>
                @else
                    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#registerModal">Войти</button>
                @endif
    {{--            </div>--}}
        </div>
        <div class="line"></div>
            <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div style="margin-top:30px;">
                <input type="name" name="name" style="margin-top:10px;" placeholder="Имя"> <br>
                <input name="surname" style="margin-top:10px;" placeholder="Фамилия"> <br>
                <input name="patronymic" style="margin-top:10px;" placeholder="Отчество"> <br>
                <input type="email" name="email" style="margin-top:10px;" placeholder="Email"> <br>
                <input type="password" name="password" id="password" style="margin-top:10px;" placeholder="Пароль"> <br>
                <input type="password" name="password_confirmation" style="margin-top:10px;" placeholder="Подтвердите пароль"> <br>
                <div class="form-group" style="width: 300px;margin-left:380px;margin-top:10px; ">
                    <label for="inputDate" style="color: white;">Введите дату рождения:</label>
                    <input type="date" name="date_of_birth" class="form-control">
                </div>
            </div>
                <input name="image" type="file" style="margin-top:10px;">
                <div style="margin-top:10px;">
                    <input class="form-check-input" name="male" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" style="color: white;" for="flexRadioDefault1">
                        Мужской
                    </label>
                </div>
                <div >
                    <input class="form-check-input" name="female" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                    <label class="form-check-label" style="color: white;" for="flexRadioDefault2">
                        Женский
                    </label>
                </div>

            <div style="margin-top:10px;">
                <button type="submit" class="btn btn-outline-light" >Регистрация</button>
            </div>
            </form>
    </div>
    </div>
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#f7fafc">
                    <h5 class="modal-title" id="exampleModalLabel">Войти</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background: url('https://catherineasquithgallery.com/uploads/posts/2021-02/1612308091_73-p-fon-purpurnii-nezhnii-82.jpg')">
                    <div>
                        <form action="{{route('login')}}" method="POST">
                            {{ csrf_field() }}
                        <input type="email" name="email" style="margin-top:10px;" placeholder="Email"> <br>
                        <input type="password" name="password" id="password" style="margin-top:10px;" placeholder="Password"> <br>
                        <button type="submit" class="btn btn-outline-light"  style="margin-top:10px;">Войти</button>
                        </form>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>
@endsection
