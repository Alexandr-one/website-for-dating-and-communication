@extends('admin.index')

@section('content')

    <table class="table">
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
@endsection
