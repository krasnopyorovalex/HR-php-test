<tr>
    <th>{{ $product->id }}</th>
    <td>{{ $product->name }}</td>
    <td>{{ $product->vendor->name }}</td>
    <td>
        <div class="price">
            <div class="price-value" title="Обновить цену">
                {{ format_as_price($product->price) }}
            </div>
            <form action="{{ route('products.update', $product) }}" method="post" class="form-update-price hidden">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <input type="text" name="price" value="{{ $product->price }}">
                <button type="submit" class="btn btn-primary btn-xs">ok</button>
            </form>
        </div>
    </td>
</tr>
