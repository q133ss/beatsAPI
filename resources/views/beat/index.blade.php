@extends('layouts.admin')
@section('title', 'Биты')
@section('content')
    <!-- Basic Tables start -->
    <a href="{{route('beat.create')}}" class="btn btn-primary mb-2">Добавить</a>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Автор</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Категория</th>
                            <th>Демо и фулл</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($beats as $beat)
                            <tr>
                                <td>{{$beat->id}}</td>
                                <td>{{$beat->author->name}}</td>
                                <td>{{$beat->name}}</td>
                                <td>{{$beat->price}}</td>
                                <td>{{$beat->category->name}}</td>
                                <td>
                                    <audio controls src="{{$beat->demoFile->src}}"></audio>
                                    <audio controls src="{{$beat->fullFile->src}}"></audio>
                                </td>
                                <td>
                                    <a href="{{route('beat.edit', $beat->id)}}">Изменить</a>
                                    <form action="{{route('beat.destroy', $beat->id)}}" style="display: inline-block" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" style="color: #ff0000" stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div style="display: flex; justify-content: center">
                        {{$beats->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection
