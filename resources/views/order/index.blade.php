@extends('layouts.app')

@section('title', 'Страница со списком заказов в табличном виде')

@section('content')
    <h3>Список всех заказов</h3>
    <hr>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Партнёр</th>
            <th>Стоимость</th>
            <th>Наименование состава заказа</th>
            <th>Статус заказа</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            @include('order._product_row')
        @endforeach
        </tbody>
    </table>
@endsection
