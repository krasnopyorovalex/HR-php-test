<?php

declare(strict_types=1);

namespace Domain\Order\Queries;

use App\Order;
use Domain\OrderStatus\OrderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetOverDueOrdersQuery
{
    /**
     * @var OrderStatus
     */
    private $orderStatus;

    /**
     * GetOverDueOrdersQuery constructor.
     * @param OrderStatus $orderStatus
     */
    public function __construct(OrderStatus $orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return Order[]|Builder[]|Collection
     */
    public function handle()
    {
        return Order::whereDate('delivery_dt', '<', now())
            ->where('status', $this->orderStatus->confirmed())
            ->limit(50)
            ->get();
    }
}
