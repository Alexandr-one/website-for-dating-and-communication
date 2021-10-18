@extends('index')

@section('content')
    @if($errors)
        <div class="alert alert-danger" role="alert">
             {{ $errors  }}
        </div>
    @endif
    <body background="storage/uploads/Background.png">
    <div  style="margin-left: 350px;background-color: #990066;width:800px;height:500px;margin-top:100px;border-radius: 40px;">
        <fieldset>
            <form action="{{route('sendToken')}}" method="POST" style="margin-left: 160px;margin-right: 160px;margin-top: 10px;" >
                @csrf
                <img style="border-radius: 40px; width: 150px; height: 150px; margin-top: 20px;"   src="https://yt3.ggpht.com/a/AATXAJxSrEdYyrQsVZ4xIBhS_P4xoVxAW8sTqsePmsV4=s900-c-k-c0x00ffffff-no-rj"><br>
                <label style="color: white;font-size: 20px;">Введите код, отправленный вам на почту</label><br>
                <input class="form-control" name="token" style="margin-top: 20px;">
                <button type="submit" class="btn btn-outline-light"  style="margin-top: 20px;">Подтвердить</button><br>
                <label style="color: white;margin-top: 20px;">какое письмо?,</label> <a href="{{route('sendMessToEmail')}}" style="margin-top: 20px;">Отправить еще раз</a>
            </form>
        </fieldset>
    </div>

    </body>
@endsection
