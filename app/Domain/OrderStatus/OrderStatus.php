<?php

declare(strict_types=1);

namespace Domain\OrderStatus;

use App\Order;

class OrderStatus
{
    private const NEW = 0;
    private const CONFIRMED = 10;
    private const COMPLETED = 20;

    private const LABELS = [
        self::NEW => 'Новый',
        self::CONFIRMED => 'Подтвержден',
        self::COMPLETED => 'Завершен'
    ];

    /**
     * @param Order $order
     * @return string
     */
    public function labelForOrder(Order $order): string
    {
        return self::LABELS[$order->status];
    }

    /**
     * @return array|string[]
     */
    public function getLabels(): array
    {
        return self::LABELS;
    }
}
