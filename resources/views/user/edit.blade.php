@extends('layouts.admin')
@section('title', 'Обновить пользователя')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action="{{route('user.update', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Имя</label>
                        <input name="name" value="{{$user->name}}" type="text" class="form-control" id="defaultFormControlInput" placeholder="Иван" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Email</label>
                        <input name="email" value="{{$user->email}}" type="email" class="form-control" id="defaultFormControlInput" placeholder="mail@email.net" aria-describedby="defaultFormControlHelp">
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label">Пароль</label>
                        <input name="password" type="password" class="form-control" id="defaultFormControlInput" placeholder="********" aria-describedby="defaultFormControlHelp">
                    </div>
                    <button class="btn btn-primary mt-1">Обновить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
