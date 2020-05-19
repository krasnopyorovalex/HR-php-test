<?php

declare(strict_types=1);

namespace Domain\Product\Queries;

use App\Product;

class GetProductsQuery
{
    /**
     * @return mixed
     */
    public function handle()
    {
        return Product::with('vendor')->oldest('name')->paginate();
    }
}
