<?php

declare(strict_types=1);

namespace Domain\Product\Queries;

use App\Product;

class GetProductByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetProductByIdQuery constructor.
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
        return Product::where('id', $this->id)->firstOrFail();
    }
}
