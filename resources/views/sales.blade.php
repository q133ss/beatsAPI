@extends('layouts.admin')
@section('title', 'Продажи')
@section('content')
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="p-2">
                <span>Фильтр:</span>
            <a href="{{route('sales.period', 'day')}}">День</a>
            <a href="{{route('sales.period', 'week')}}">Неделя</a>
            <a href="{{route('sales.period', 'month')}}">Месяц</a>
            <a href="{{route('sales.period', 'year')}}">Год</a>
            </div>
            <div class="card">
                @if(isset($count))
                Всего продаж: {{$count}}
                <br>
                Доход за период: {{$totalPrice}}
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Цена</th>
                            <th>Статус</th>
                            <th>Бит</th>
                            <th>Пользователь</th>
                            <th>Дата и время</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{$sale->id}}</td>
                                <td>{{$sale->price}}</td>
                                <td class="{{$statuses[$sale->status]['class']}}">{{$statuses[$sale->status]['label']}}</td>
                                <td><a href="{{route('beat.edit', $sale->beat ? $sale->beat->id : '')}}">{{$sale->beat ? $sale->beat->name : ''}}</a></td>
                                <td><a href="{{route('beat.edit', $sale->user ? $sale->user->id : '')}}">{{$sale->user ? $sale->user->name : ''}}</a></td>
                                <td>{{$sale->created_at->format('d.m.Y H:i')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection
