@extends('layouts.admin')
@section('title', 'Добавить бит')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('beat.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Название</label>
                        <input name="name" type="text" class="form-control" id="defaultFormControlInput" placeholder="бит" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Название на английском</label>
                        <input name="en_name" type="text" class="form-control" id="defaultFormControlInput" placeholder="beat" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Цена RUB</label>
                        <input name="price" type="number" class="form-control" id="defaultFormControlInput" placeholder="1999" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Автор</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="author_id">
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>

                        <div>
                            <label for="defaultFormControlInput" class="form-label">Категория</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="demoFile" class="form-label">Демо файл</label>
                            <input class="form-control" name="demo_file" type="file" id="demoFile">
                        </div>

                        <div>
                            <label for="fullFile" class="form-label">Полная версия</label>
                            <input class="form-control" name="full_file" type="file" id="fullFile">
                        </div>

                    <button class="btn btn-primary mt-1">Добавить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
