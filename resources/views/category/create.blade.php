@extends('layouts.admin')
@section('title', 'Добавить категорию')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Название</label>
                        <input name="name" type="text" class="form-control" id="defaultFormControlInput" placeholder="Категория" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Родительская категория</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="parent_id">
                            <option selected="" value="">Отсутствует</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary mt-1">Добавить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
