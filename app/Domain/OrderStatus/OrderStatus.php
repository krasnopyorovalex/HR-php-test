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
     * @return int
     */
    public function new(): int
    {
        return self::NEW;
    }

    /**
     * @return int
     */
    public function confirmed(): int
    {
        return self::CONFIRMED;
    }

    /**
     * @return int
     */
    public function completed(): int
    {
        return self::COMPLETED;
    }

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

    /**
     * @param Order $order
     * @return bool
     */
    public function isCompleted(Order $order): bool
    {
        return $order->status === $this->completed();
    }
}
