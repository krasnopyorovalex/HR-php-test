<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Order\Queries\GetOrderByIdQuery;
use Domain\Order\Queries\GetOrdersQuery;
use Domain\OrderStatus\OrderStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @var OrderStatus
     */
    private $orderStatus;

    public function __construct(OrderStatus $orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $orders = $this->dispatch(new GetOrdersQuery);

        return view('order.index', [
            'orders' => $orders,
            'orderStatus' => $this->orderStatus
        ]);
    }

    /**
     * @param int $id
     * @return Factory|Application|View
     */
    public function edit(int $id)
    {
        $order = $this->dispatch(new GetOrderByIdQuery($id));
        $orderStatuses = $this->orderStatus->getLabels();

        return view('order.edit', [
            'order' => $order,
            'orderStatuses' => $orderStatuses
        ]);
    }
}
