<?php

declare(strict_types=1);

namespace Domain\Order\Queries;

use App\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetOrdersQuery
{
    /**
     * @return Order[]|Builder[]|Collection
     */
    public function handle()
    {
        return Order::with(['partner', 'orderProducts' => static function($query) {
                return $query->selectRaw('*, price*quantity as total');
            }])
            ->limit(20)
            ->get();
    }
}
