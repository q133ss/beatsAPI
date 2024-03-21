@extends('layouts.admin')
@section('title', 'Заявки')
@section('content')
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Дата и время</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $app)
                            <tr>
                                <td>{{$app->id}}</td>
                                <td>{{$app->name}}</td>
                                <td>{{$app->phone}}</td>
                                <td>{{$app->created_at->format('d.m.Y H:i')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="display: flex; justify-content: center" class="mt-2">
                        {{$applications->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection
