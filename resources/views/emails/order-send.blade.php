<p>заказ №({{ $order->id }}) завершен</p>

<ul>
    @foreach($order->orderProducts as $orderProduct)
        <li>
            {{ $orderProduct->product->name }} - <b>{{ $orderProduct->quantity }}</b>
        </li>
    @endforeach
</ul>

<p>стоимость заказа: {{ format_as_price($order->orderProducts->sum('total')) }}</p>
