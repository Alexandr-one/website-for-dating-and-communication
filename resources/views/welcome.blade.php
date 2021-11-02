@extends('index')

@section('content')
<style>body {
        background-size: cover;
    }</style>
    @if($loginError)
        <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            {{$loginError}}
        </ul>
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
<body background="storage/uploads/Background.png">

<div class="space" style="background-color: white;   padding: 20px;border-radius:40px;border: 4px;border-color: #f00;margin-top: 2px; margin-left: 200px;margin-right: 200px;">
    <div style="margin-left: 100px;margin-right: 100px;">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <h4 class="mb-3" style="margin-left: 240px;color: #990066">Регистрация на сайте знакомств <span style="font-style: oblique">Dating</span>                <img style="border-radius: 40px; width: 30px; height: 30px;"   src="https://yt3.ggpht.com/a/AATXAJxSrEdYyrQsVZ4xIBhS_P4xoVxAW8sTqsePmsV4=s900-c-k-c0x00ffffff-no-rj">
        </h4>
{{--            @if(Auth::user())--}}
{{--            <a type="button" href="{{route("index")}}" class="btn btn-outline-light" style="margin-left: 180px;background-color: #990066">{{Auth::user()->name}}</a>--}}
{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="btn btn-outline-light" style="margin-left:10px;background-color: #990066">Выйти</button>--}}
{{--            </form>--}}
{{--        @else--}}
{{--            <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#registerModal" style="margin-left: 295px;background-color: #990066">Войти</button>--}}
{{--        @endif--}}

        </div>
        <form class="needs-validation" novalidate="" action="{{route('register')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Имя</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" name="name" required="" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Фамилия</label>
                    <input type="text" class="form-control" id="lastName" name="surname" placeholder="" value="" required="">
                </div>
            </div>
            <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Обязательный)</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Пароль</label><br>
                    <input type="password" class="form-control" id="cc-expiration" name="password" placeholder="" required="">
                    <div class="mb-3">
                        <label style="margin-top: 30px;">Выберите пол</label>
                        <div style="margin-top:10px;margin-left: 20px;">
                            <input class="form-check-input" name="male" type="radio"  style="float: left;">
                            <label class="form-check-label" style="color: black;" for="flexRadioDefault1">
                                Мужской
                            </label>
                        </div>
                        <div style="margin-left: 20px;margin-top:15px;">
                            <input class="form-check-input" name="female" type="radio" >
                            <label class="form-check-label" style="color: black;">
                                Женский
                            </label>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label>Введите город</label>
                            <input type="text" class="form-control" name="town">
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Подтвердите пароль</label><br>
                    <input type="password" class="form-control" name="password_confirmation" id="cc-cvv" placeholder="" required="">
                    <div class="mb-3">
                        <label style="float: left;margin-top: 30px;">Введите дату рождения:</label><br><br>
                        <input type="date" name="date_of_birth" class="form-control" style="width: 200px;">
                    </div>
                    <div class="mb-3" style="margin-top: 55px;">
                        <label for="email">Введите вашу страну</label>
                        <input type="text" class="form-control" name="country">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="input__wrapper">
                        <img id="image_preview" src="storage/uploads/unknown.jpg" height="300" width="300" alt=""/>
                        <script type="text/javascript">function AddImg(){image_preview.src = URL.createObjectURL(event.target.files[0])}
                            function DeleteImg(){document.querySelector('.test').value = ''; image_preview.src = ""; URL.revokeObjectURL(image_preview.src)}</script>
                        <input name="image" type="file" id="input__file" class="input input__file" multiple accept="image/*" onchange="AddImg();">
                        <label for="input__file" class="input__file-button" style="margin-top: 5px;background-color: #990066">
                            <span class="input__file-icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                    <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                            </span>
                            <span class="input__file-button-text">Выберите изображение</span>
                        </label>
                    </div>
                </div>
            </div>
            <hr >

            <button class="btn btn-outline-light btn-lg btn-block" type="submit" style="background-color: #990066">Продолжить регистрацию</button>
        </form>
    </div>
</div>




    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border:none">
                <div class="modal-header" style="background-color: #990066">
                    <h5 class="modal-title" id="exampleModalLabel"style="color:white">Войти</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                </div>
                <form action="{{route('login')}}" method="POST">

                <div class="modal-body" style="background:white">
                    <div>
                            {{ csrf_field() }}
                        <input type="email" name="email" style="margin-top:10px;" class="form-control" placeholder="Email"> <br>
                        <input type="password" name="password" id="password" style="margin-top:10px;"  class="form-control" placeholder="Password"> <br>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #990066">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-outline-light" >Войти</button>
                </div>
        </form>

    </div>
        </div>
    </div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>
<script>

</script>
    <style>
        .input__wrapper {
            width: 100%;
            position: relative;
            margin: 15px 0;
            text-align: center;
        }

        .input__file {
            opacity: 0;
            visibility: hidden;
            position: absolute;
        }

        .input__file-icon-wrapper {
            height: 60px;
            width: 60px;
            margin-right: 15px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            border-right: 1px solid #fff;
        }

        .input__file-button-text {
            line-height: 1;
            margin-top: 1px;
        }

        .input__file-button {
            width: 100%;
            max-width: 300px;
            height: 60px;
            background: deepskyblue;
            color: #fff;
            font-size: 1.125rem;
            font-weight: 700;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            border-radius: 3px;
            cursor: pointer;
            margin: 0 auto;
        }
    </style>
@endsection
