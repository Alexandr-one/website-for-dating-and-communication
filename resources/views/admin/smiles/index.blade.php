@extends('admin.index')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                @foreach ($errors->all() as $smileError)
                    {{ $smileError }}
                @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
    @endif
    @if($error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error  }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" style="margin-left: 5px;">Добавить
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
        </svg>
    </button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Удалить
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"></path>
        </svg>
    </button>
    <br><br>
        <div class="row">
        @foreach($smiles as $smile)
                <div class="col-2" >
                    <button type="button" data-toggle="modal" data-target="#imageModel" style="float: left;background: transparent;
    border: none !important;" class="smile_info" data-id="{{$smile->id}}">
                        <img src="http://localhost:8000/storage/{{$smile->content}}" style="width: 150px; height: 150px;">
                    </button>
                </div>
        @endforeach
        </div>
        <div class="modal fade" id="imageModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width:0%;height: 0%;">
                    <div class="modal-body" style="width:0%;height: 0%;">
                    <input  type="hidden" id="messageId" value="" class="messageId" name="id" style="outline: none;border: none; ">
                        <img class="image" style="object-fit: contain;width:680px;height: 680px;"><br>
                    <button class="btn btn-danger deleteSmile" style="margin-left: 20px;">Удалить</button>
                    </div>
                </div>
            </div>

        </div>
    <script>
        $(document).ready(function() {
            $('.smile_info').click(function(){
                let id = $(this).data('id');
                console.log(id)
                $.ajax({
                    url: 'http://localhost:8000/api/get_smile/' + id,
                    type: "GET",
                    success: function (data) {
                        document.querySelector('.messageId').value = data.id;
                        document.querySelector('.image').src = "/storage/" +  data.content;
                    }
                });
            });
            $('.deleteSmile').click(function (){
                let id = document.getElementById('messageId').value
                console.log(id);
                $.ajax({
                    url: 'http://localhost:8000/api/delete_smile/' + id,
                    type: "POST",
                    success: function (data) {
                        location.reload();
                    }
                });
            });
        });
    </script>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление смайликов</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('addSmile')}}" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="file" name="content" class="form-control" style="background-color: limegreen">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Добавить</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удаление смайликов</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('deleteSmile')}}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="text" placeholder="Введите id смайлика" name="id" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
