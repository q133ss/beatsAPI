@extends('layouts.admin')
@section('title', 'Обновить категорию')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('category.update', $category->id)}}" method="POST">
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
                        <input name="name" type="text" value="{{old('name') != null ? old('name') : $category->name}}" class="form-control" id="defaultFormControlInput" placeholder="Категория" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Родительская категория</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="parent_id">
                            <option value="">Отсутствует</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}" @if($category->parent_id == $cat->id) selected @endif>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary mt-1">Обновить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
