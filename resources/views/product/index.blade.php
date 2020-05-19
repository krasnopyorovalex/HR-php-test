@extends('layouts.app')

@section('title', 'Список продуктов')

@section('content')
    <h3>Список продуктов</h3>
    <hr>
    @include('layouts.partials.flash-message')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Наименование продукта</th>
            <th>Наименование поставщика</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            @include('product._product_row')
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
