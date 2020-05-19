<?php

declare(strict_types=1);

namespace Domain\Product\Commands;

use App\Http\Requests\Request;
use App\Product;

class UpdateProductCommand
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Product
     */
    private $product;

    /**
     * UpdateProductCommand constructor.
     * @param Product $product
     * @param Request $request
     */
    public function __construct(Product $product, Request $request)
    {
        $this->product = $product;
        $this->request = $request;
    }

    public function handle(): void
    {
        $this->product->update($this->request->validated());
    }
}
