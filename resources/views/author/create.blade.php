@extends('layouts.admin')
@section('title', 'Добавить автора')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('author.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Название</label>
                        <input name="name" type="text" class="form-control" id="defaultFormControlInput" placeholder="автор" aria-describedby="defaultFormControlHelp">
                    </div>
                    <button class="btn btn-primary mt-1">Добавить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
