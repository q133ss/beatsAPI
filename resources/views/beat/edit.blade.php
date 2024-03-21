@extends('layouts.admin')
@section('title', 'Обновить бит')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('beat.update', $beat->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Название</label>
                        <input name="name" type="text" class="form-control" id="defaultFormControlInput" value="{{$beat->name}}" placeholder="бит" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Название на английском</label>
                        <input name="en_name" type="text" class="form-control" id="defaultFormControlInput" value="{{$beat->en_name}}" placeholder="beat" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Цена RUB</label>
                        <input name="price" type="number" class="form-control" id="defaultFormControlInput" value="{{$beat->price}}" placeholder="1999" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Автор</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="author_id">
                            @foreach($authors as $author)
                                <option @if($author->id == $beat->auhor_id) selected @endif value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Категория</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == $beat->category_id) selected @endif >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="demoFile" class="form-label">Демо файл</label>
                        <br>
                        <audio controls src="{{$beat->demoFile->src}}"></audio>
                        <input class="form-control" name="demo_file" type="file" id="demoFile">
                    </div>

                    <div>
                        <label for="fullFile" class="form-label">Полная версия</label>
                        <br>
                        <audio controls src="{{$beat->fullFile->src}}"></audio>
                        <input class="form-control" name="full_file" type="file" id="fullFile">
                    </div>

                    <button class="btn btn-primary mt-1">Добавить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
