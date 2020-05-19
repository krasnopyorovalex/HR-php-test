<?php

declare(strict_types=1);

namespace App\Domain\Order\Commands;

use App\Events\OrderCompleted;
use App\Http\Requests\Request;
use App\Order;
use Domain\OrderStatus\OrderStatus;

class UpdateOrderCommand
{
    /**
     * @var Order
     */
    private $order;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var OrderStatus
     */
    private $orderStatus;

    /**
     * UpdateOrderCommand constructor.
     * @param Order $order
     * @param Request $request
     * @param OrderStatus $orderStatus
     */
    public function __construct(Order $order, Request $request, OrderStatus $orderStatus)
    {
        $this->order = $order;
        $this->request = $request;
        $this->orderStatus = $orderStatus;
    }

    public function handle(): void
    {
        $this->order->update($this->request->validated());

        if ($this->order->wasChanged('status') && $this->orderStatus->isCompleted($this->order->refresh())) {
            event(new OrderCompleted($this->order));
        }
    }
}
