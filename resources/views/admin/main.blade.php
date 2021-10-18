@extends('admin.index')

@section('content')
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header" style="background-color: #990066">
                            <h4 class="my-0 font-weight-normal" style="color: white">Пользователи</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Количество: {{\App\Models\User::count()}} </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{\App\Models\User::where('sex','=','мужской')->count()}} мужчин</li>
                                <li>{{\App\Models\User::where('sex','=','женский')->count()}} женщин</li>
                                <li>{{\App\Models\User::where('age','>=',18)->count()}} совершеннолетних</li>
                                <li>{{\App\Models\User::where('age','<',18)->count()}} несовершеннолетних</li>
                            </ul>
                            <a type="button" href="{{route('users')}}"  class="btn btn-lg btn-block btn-outline-light" style="border-color: #990066;color: white;background-color: #990066">Открыть</a>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header" style="background-color: #990066">
                            <h4 class="my-0 font-weight-normal" style="color: white">Чаты</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Количество: {{\App\Models\ChatUserModel::count() / 2}}</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{\App\Models\Message::where('content','like','uploads%.jpg')->count()}} изображений</li>
                                <li>{{\App\Models\Message::where('content','like','uploads%.docx')->count()}} документов</li>
                                <li>Содержат смайлики</li>
                                <li>{{\App\Models\Message::count() - \App\Models\Message::where('content','like','uploads%')->count()}} текстовых сообщений</li>
                            </ul>
                            <a type="button" href="{{route('chats')}}" class="btn btn-lg btn-block btn-outline-light" style="border-color: #990066;color: white;background-color: #990066">Открыть</a>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header" style="background-color: #990066">
                            <h4 class="my-0 font-weight-normal" style="color: white">Лайки</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Количество: {{\App\Models\LikeUser::count()}}</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <button type="button" class="btn btn-outline-danger">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                </button>
                                <p style="margin-top: 33px;">У {{$userMaxLike->name}} {{$userMaxLike->surname}} больше всего лайков: {{$countMaxLike}}</p>
                            </ul>
                            <a type="button" href="{{route('likes')}}"  class="btn btn-lg btn-block btn-outline-light" style="border-color: #990066;color: white;background-color: #990066">Открыть</a>
                        </div>
                    </div>
                </div>
                <div class="text-center card-deck mb-3" >
                    <div class="card mb-4 box-shadow">
                        <div class="card-header" style="background-color: #990066">
                            <h4 class="my-0 font-weight-normal" style="color: white">Смайлики</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Количество: {{\App\Models\SmileModel::count()}} </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <img src="https://avatars.mds.yandex.net/get-zen_doc/3765046/pub_5fbd0e7d9e832457051d3cd7_5fbdd86b6ea65c24b33f359d/scale_1200" style="height: 120px;width: auto">
                            </ul>
                            <a type="button" href="{{route('smiles')}}"  class="btn btn-lg btn-block btn-outline-light" style="border-color: #990066;color: white;background-color: #990066">Открыть</a>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header" style="background-color: #990066">
                            <h4 class="my-0 font-weight-normal" style="color: white">Сообщения</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Количество: {{\App\Models\Message::count()}}</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{\App\Models\Message::where('content','like','uploads%.jpg')->count()}} изображений</li>
                                <li>{{\App\Models\Message::where('content','like','uploads%.docx')->count()}} документов</li>
                                <li>Содержат смайлики</li>
                                <li>{{\App\Models\Message::count() - \App\Models\Message::where('content','like','uploads%')->count()}} текстовых сообщений</li>
                            </ul><br>
                            <a type="button"  href="{{route('messages')}}" class="btn btn-lg btn-block btn-outline-light" style="border-color: #990066;color: white;background-color: #990066">Открыть</a>
                        </div>
                    </div>
                </div>
@endsection
