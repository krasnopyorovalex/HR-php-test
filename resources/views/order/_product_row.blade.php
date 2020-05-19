<tr>
    <th>
        <a href="{{ $order->url }}" target="_blank">
            {{ $order->id }}
        </a>
    </th>
    <td>{{ $order->partner->name }}</td>
    <td>{{ format_as_price($order->orderProducts->sum('total')) }}</td>
    <td>{{ $order->orderProducts->implode('product.name', ', ') }}</td>
    <td><span class="label label-primary">{{ $orderStatus->labelForOrder($order) }}</span></td>
</tr>
