@extends('admin.index')

@section('content')
    @if($errors)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors  }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else($message and !$errors)
        <div class="alert alert-warning alert-dismissible fade show" role="alert" >
            <p>{{ $message  }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form class="w-100 me-3 form-inline" style="margin-left: 10px; " action="{{route('users')}}">
        <button type="button" class="btn btn-outline-light" style="background-color: #990066" data-toggle="modal" data-target="#filterModal">
            Фильтр
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="background-color: #990066;border: white;margin-left: 10px;">
            Изменить статус
        </button>
        <input type="search " name='nameFilled' class="form-control" value="{{ $getNamePar }}" placeholder="Имя" aria-label="Search" style="margin-left: 10px; width: 200px;">
        <input type="search " name='surnameFilled' class="form-control" value="{{ $getSurnamePar }}" placeholder="Фамилия" aria-label="Search" style="width: 200px; margin-left: 10px;">
        <button type="submit" style=" margin-left: 5px; background-color: #990066" class="btn btn-outline-light">Поиск</button>
        <a type="button" class="btn btn-outline-light" style="background-color: #990066; margin-left: 5px;" href="{{route('users')}}">Сбросить</a>
    </form>
    <table class="table" style="margin-top: 10px;">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Email</th>
            <th scope="col">Изображение</th>
            <th scope="col">Пол</th>
            <th scope="col">Возраст</th>
            <th scope="col">Город</th>
            <th scope="col">Страна</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)

        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->email}}</td>
            <td><img src="http://localhost:8000/storage/{{$user->image}}" style="width: 50px; height: 50px;border-radius: 40px;"></td>
            <td>{{$user->sex}}</td>
            <td>{{$user->age}}</td>
            <td>{{$user->town}}</td>
            <td>{{$user->country}}</td>
            <td>{{$user->status}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div style="margin-top:10px;">
        {{ $users->links("pagination::bootstrap-4") }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изменение статуса</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('changeStatus')}}">
                    @csrf
                <div class="modal-body">
                    <input class="form-control" name="user_id" placeholder="Введите id пользователя">
                    <input class="form-control" name="user_status" placeholder="Введите статус" style="margin-top: 5px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #990066; border: white">Изменить</button>
                </div>
                </form>
            </div>
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
                    <form action="{{route('users')}}">
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
                        </select>
                        <br>
                        <input name='min_age' class="form-control" value="{{ $getAgeMinPar }}" style=" margin-top:10px;" placeholder="Минимальный возраст">
                        <input name='max_age' class="form-control" value="{{ $getAgeMaxPar }}" style=" margin-top:10px;" placeholder="Максимальный возраст">
                        <br>
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
@endsection
