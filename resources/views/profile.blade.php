@extends('index')

@section('content')

    @if($message)
        <div class="alert alert-success" role="alert">
            {{ $message  }}
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
        <div>
            <div>
                <div>
                    <div id="about">
                        <img src="storage/{{Auth::user()->image}}" alt="mdo" width="300" height="300" class="rounded-circle">
                        <h3 class="media-heading text-light">{{Auth::user()->name}} {{Auth::user()->surname}}<small><br> {{Auth::user()->country}}, {{Auth::user()->town}}</small></h3>
                        <a type="button" class="btn btn-outline-light" href="{{route('index')}}">На главную страницу</a>
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
                        <div style="margin-top:30px;">
                            <input type="name" name="name" style="margin-top:10px;" value="{{Auth::user()->name}}"> <br>
                            <input name="surname" style="margin-top:10px;" placeholder="Фамилия" value="{{Auth::user()->surname}}"> <br>
                            <input name="patronymic" style="margin-top:10px;" placeholder="Отчество" value="{{Auth::user()->patronymic}}"> <br>
                            <input type="email" name="email" style="margin-top:10px;" placeholder="Email" value="{{Auth::user()->email}}"> <br>
                            <input type="text" name="country" style="margin-top:10px;" placeholder="Страна" value="{{Auth::user()->country}}"> <br>
                            <input name="town" style="margin-top:10px;" placeholder="Город" value="{{Auth::user()->town}}"> <br>
                            <textarea name="description" style="margin-top:10px;"></textarea>
                        </div>
                        <input name="image" type="file" style="margin-top:10px;">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-outline-success">Сохранить</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection