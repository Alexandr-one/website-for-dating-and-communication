@extends('index')

@section('content')
    <body background="storage/uploads/Background.png">
    <div class="container" style="margin-left: 250px;margin-top: 20px;">
        <div class="row">
            <div class="col-sm-4" style="background-color: #990066;width: 600px;height: 700px;border-radius: 40px;box-shadow: 0 0 10px rgba(0,0,0,0.5)">
                <img style="border-radius: 40px; width: 200px; height: 200px; margin-top: 20px;"   src="https://yt3.ggpht.com/a/AATXAJxSrEdYyrQsVZ4xIBhS_P4xoVxAW8sTqsePmsV4=s900-c-k-c0x00ffffff-no-rj">
                <h1 style="color: white">Добро пожаловать на сайт знакомств <span style="font-style: oblique">Dating</span></h1>

                <h1 style="color: white;margin-top: 100px;">Всего пользователей: {{$users->count()}}</h1>
                <div class="block-1__meet-wrapper" style="margin-top: 100px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9%" viewBox="0 0 34 34" >
                        <g fill="#070077" fill-rule="nonzero">
                            <path d="M32.961 17.637l-2.226-2.566a1.985 1.985 0 0 1-.41-1.858l.892-3.088c.755-2.615-1.257-5.211-3.993-5.114l-3.386.121a1.987 1.987 0 0 1-1.68-.816l-1.95-2.67c-1.602-2.195-4.87-2.194-6.47 0l-1.95 2.67a1.99 1.99 0 0 1-1.681.816L6.72 5.011c-2.726-.099-4.749 2.492-3.992 5.114l.891 3.088a1.985 1.985 0 0 1-.409 1.858L.984 17.637c-1.811 2.088-1.019 5.32 1.534 6.344l2.953 1.184a2.006 2.006 0 0 1 1.222 1.513l.561 3.281c.468 2.732 3.51 4.176 5.923 2.81l2.814-1.592a2.003 2.003 0 0 1 1.963 0l2.814 1.592c2.403 1.361 5.453-.067 5.922-2.81l.562-3.28a2.006 2.006 0 0 1 1.222-1.514l2.952-1.184c2.556-1.025 3.345-4.258 1.535-6.344zm-2.284 4.475l-2.953 1.184a4.031 4.031 0 0 0-2.457 3.043l-.561 3.28a1.991 1.991 0 0 1-2.946 1.399l-2.814-1.594a4.027 4.027 0 0 0-3.947 0l-2.814 1.594a1.991 1.991 0 0 1-2.946-1.398l-.561-3.281a4.032 4.032 0 0 0-2.457-3.043l-2.953-1.184a1.991 1.991 0 0 1-.763-3.155L4.73 16.39a3.992 3.992 0 0 0 .823-3.737l-.891-3.087a1.991 1.991 0 0 1 1.985-2.544l3.387.121a4.001 4.001 0 0 0 3.378-1.64l1.95-2.671a1.991 1.991 0 0 1 3.219 0l1.95 2.67a3.998 3.998 0 0 0 3.378 1.641l3.387-.121a1.991 1.991 0 0 1 1.985 2.544l-.891 3.087a3.99 3.99 0 0 0 .823 3.737l2.226 2.566a1.991 1.991 0 0 1-.763 3.155z"></path>
                            <path d="M12.069 16.398h3.136a.7.7 0 0 0 0-1.398H12.79a.72.72 0 0 1 .387-.474l1.526-.728c2.036-.997 1.333-4.1-.944-4.1a2.39 2.39 0 0 0-2.388 2.388.699.699 0 1 0 1.398 0c0-.546.444-.99.99-.99.797 0 1.037 1.097.332 1.446l-1.515.722a2.125 2.125 0 0 0-1.205 1.91v.525c0 .386.313.699.699.699zM17.562 14.682h2.223v1.017a.699.699 0 0 0 1.397 0v-1.017h.08a.7.7 0 0 0 0-1.398h-.08v-.405a.699.699 0 1 0-1.397 0v.405h-1.03l1.429-2.545a.699.699 0 1 0-1.22-.684l-2.012 3.586a.7.7 0 0 0 .61 1.041zM23.822 17.642H10.123a.839.839 0 0 0 0 1.678h13.699a.839.839 0 0 0 0-1.678zM17.948 20.587h-2.566a.7.7 0 0 0 0 1.398h1.645l-.944 3.377a.699.699 0 0 0 1.347.376l1.191-4.264a.7.7 0 0 0-.673-.887z"></path>
                        </g>
                    </svg>
                    <b class="block-1__meet" style="color: darkblue; font-size: 30px;margin-top: 30px;margin-left: 5px;">
                        Знакомьтесь онлайн 24/7 </b>
                </div>
            </div>
            <div class="col-sm-4" style="background-color: white;width:400px;height:400px;margin-top:150px;box-shadow: 0 0 10px rgba(0,0,0,0.5);border-radius:0px 40px 40px 0px;">
                <div id="login-form" style="margin-top: 70px;">

                    <h1 style="color: #990066;">АВТОРИЗАЦИЯ</h1>
                    <fieldset>
                        <form action="{{route('login')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="email" name="email" style="margin-top:10px;" class="form-control" placeholder="Email"> <br>
                            <input type="password" name="password" id="password" style="margin-top:10px;"  class="form-control" placeholder="Password"> <br>
                            <button type="submit" class="btn btn-outline-light" style="background-color: #990066;">Войти</button>
                        </form>
                    </fieldset>
                    <div style="margin-top: 10px;">
                        <a href="{{route('homepage')}}" >Регистрация</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
@endsection
