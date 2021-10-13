@extends('index')

@section('content')
<body style="background: url('storage/uploads/Background.png');">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="login-form">

    <h1 style="color: #990066;">АВТОРИЗАЦИЯ</h1>
    <fieldset>
        <form action="{{route('login')}}" method="POST">
            {{ csrf_field() }}
            <input type="email" name="email" style="margin-top:10px;" class="form-control" placeholder="Email"> <br>
            <input type="password" name="password" id="password" style="margin-top:10px;"  class="form-control" placeholder="Password"> <br>
            <button type="submit" class="btn btn-outline-light" style="background-color: #990066;">Войти</button>
        </form>
        <a href="{{route('homepage')}}">Регистрация</a>
    </fieldset>
</div>
</body>
</html>
    <style>

        #login-form {
            background-color: white;
            border-radius: 5px;
            border-bottom-color: #1a202c;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            margin: 150px auto;
            width: 600px;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            -webkit-box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);
            box-shadow:  0px 10px 20px 0px rgba(0, 0, 0, 0.3);

        }

        #login-form h1 {
            /*background-color: #292829;*/
            border-radius: 5px 5px 0px 0px;
            -moz-border-radius: 5px 5px 0px 0px;
            -webkit-border-radius: 5px 5px 0px 0px;
            /*color: #fff;*/
            padding: 20px;
            text-align: center;
            text-transform: uppercase;
            font-family: 'Open Sans', sans-serif;
            font-size: 20px;
        }

        #login-form fieldset {
            border: none;
            padding: 20px;
            position: relative;
        }



    </style>
@endsection
