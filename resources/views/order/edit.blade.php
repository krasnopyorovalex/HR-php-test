@extends('layouts.app')

@section('title', 'Страница редактирования заказа')

@section('content')
    <h3>Форма редактирования заказа</h3>
    <hr>
    <form action="{{ route('orders.update', $order) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="field-client-email">Email клиента</label>
                    <input type="email" class="form-control" id="field-client-email" name="client_email" value="{{ old('client_email', $order->client_email) }}" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="field-partner">Партнер</label>
                    <input type="text" class="form-control" id="field-partner" name="partner" value="{{ old('partner', $order->partner->name) }}" autocomplete="off">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="field-status">Статус заказа</label>
                    <select name="status" id="field-status" class="form-control">
                        @foreach($orderStatuses as $key => $label)
                            <option value="{{ $key }}" {{ $key === $order->status ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Список товаров:</h4>
                <ul class="list-group">
                    @foreach($order->orderProducts as $orderProduct)
                        <li class="list-group-item">
                            <span class="badge">{{ $orderProduct->quantity }}</span>
                            {{ $orderProduct->product->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6"></div>
        </div>
        <h4>Стоимость заказа: <span class="label label-primary">{{ $order->orderProducts->sum('total') }}</span></h4>
        <button type="submit" class="btn btn-default">Сохранить</button>
    </form>
@endsection
