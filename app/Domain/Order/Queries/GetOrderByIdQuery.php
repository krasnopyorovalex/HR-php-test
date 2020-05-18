<?php

declare(strict_types=1);

namespace App\Domain\Order\Queries;

use App\Order;

class GetOrderByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetOrderByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return Order::where('id', $this->id)->with(['orderProducts' => static function($query) {
            return $query->selectRaw('*, price*quantity as total');
        }])->firstOrFail();
    }
}
