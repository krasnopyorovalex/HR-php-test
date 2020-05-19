<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Product\Commands\UpdateProductCommand;
use Domain\Product\Queries\GetProductByIdQuery;
use Domain\Product\Queries\GetProductsQuery;
use Domain\Product\Requests\UpdateProductRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $products = $this->dispatch(new GetProductsQuery);

        return view('product.index', [
            'products' => $products
        ]);
    }

    /**
     * @param int $id
     * @param UpdateProductRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdateProductRequest $request): JsonResponse
    {
        try {
            $product = $this->dispatch(new GetProductByIdQuery($id));

            $this->dispatch(new UpdateProductCommand($product, $request));
        } catch (Exception $exception) {
            return response()->json([
                'status' => $exception->getMessage()
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'price' => $product->refresh()->price
        ]);
    }
}
