<?php

declare(strict_types=1);

namespace Domain\Order\Queries;

use App\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetActualOrdersQuery
{
    /**
     * @return Order[]|Builder[]|Collection
     */
    public function handle()
    {
        return Order::whereDate('delivery_dt', '>=', today())
            ->oldest('delivery_dt')
            ->get();
    }
}
