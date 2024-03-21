@extends('layouts.admin')
@section('title', 'Обновить автора')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('author.update', $author->id)}}" method="POST">
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
                        <input name="name" type="text" value="{{old('name') != null ? old('name') : $author->name}}" class="form-control" id="defaultFormControlInput" placeholder="Категория" aria-describedby="defaultFormControlHelp">
                    </div>

                    <button class="btn btn-primary mt-1">Обновить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
