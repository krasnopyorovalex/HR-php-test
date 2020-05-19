@extends('layouts.app')

@section('title', 'Страница со списком заказов в табличном виде')

@section('content')
    <h3>Список всех заказов</h3>
    <hr>
    @include('layouts.partials.flash-message')
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Просроченные</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Текущие</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Новые</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Выполненные</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <table class="table table-bordered">
                    <thead>
                    @include('order._product_row_header')
                    </thead>
                    <tbody>
                    @foreach($overDueOrders as $order)
                        @include('order._product_row')
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <table class="table table-bordered">
                    <thead>
                    @include('order._product_row_header')
                    </thead>
                    <tbody>
                    @foreach($actualOrders->currentOrders() as $order)
                        @include('order._product_row')
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                <table class="table table-bordered">
                    <thead>
                    @include('order._product_row_header')
                    </thead>
                    <tbody>
                    @foreach($actualOrders->newOrders() as $order)
                        @include('order._product_row')
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <table class="table table-bordered">
                    <thead>
                    @include('order._product_row_header')
                    </thead>
                    <tbody>
                    @foreach($actualOrders->completedOrders() as $order)
                        @include('order._product_row')
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
