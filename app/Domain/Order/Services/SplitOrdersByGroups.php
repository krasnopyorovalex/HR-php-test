<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use App\Order;
use Domain\OrderStatus\OrderStatus;
use Illuminate\Database\Eloquent\Collection;

class SplitOrdersByGroups
{
    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var OrderStatus
     */
    private $orderStatus;

    /**
     * @param Collection $collection
     * @param OrderStatus $orderStatus
     * @return $this
     */
    public function configure(Collection $collection, OrderStatus $orderStatus): self
    {
        $this->collection = $collection;
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * @return Collection
     */
    public function currentOrders(): Collection
    {
        return $this->collection->filter(function (Order $order) {
            return $order->status === $this->orderStatus->confirmed() && $order->delivery_dt <= now()->addHour(24);
        });
    }

    /**
     * @return Collection
     */
    public function newOrders(): Collection
    {
        return $this->collection->filter(function (Order $order) {
            return $order->status === $this->orderStatus->new() && $order->delivery_dt > now();
        })->take(50);
    }

    /**
     * @return Collection
     */
    public function completedOrders(): Collection
    {
        return $this->collection->filter(function (Order $order) {
            return $order->status === $this->orderStatus->completed()
                && ($order->delivery_dt >= today() || $order->delivery_dt <= today()->addHour(24));
        })->take(-50);
    }
}
