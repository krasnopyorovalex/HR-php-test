<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Order\Commands\UpdateOrderCommand;
use App\Domain\Order\Queries\GetOrderByIdQuery;
use Domain\Order\Queries\GetActualOrdersQuery;
use Domain\Order\Queries\GetOverDueOrdersQuery;
use Domain\Order\Requests\UpdateOrderRequest;
use Domain\Order\Services\SplitOrdersByGroups;
use Domain\OrderStatus\OrderStatus;
use Domain\Partner\Queries\GetAllPartnersQuery;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @var OrderStatus
     */
    private $orderStatus;
    /**
     * @var SplitOrdersByGroups
     */
    private $splitOrdersByGroups;

    /**
     * OrderController constructor.
     * @param OrderStatus $orderStatus
     * @param SplitOrdersByGroups $splitOrdersByGroups
     */
    public function __construct(OrderStatus $orderStatus, SplitOrdersByGroups $splitOrdersByGroups)
    {
        $this->orderStatus = $orderStatus;
        $this->splitOrdersByGroups = $splitOrdersByGroups;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $overDueOrders = $this->dispatch(new GetOverDueOrdersQuery($this->orderStatus));
        $actualOrders = $this->dispatch(new GetActualOrdersQuery);

        return view('order.index', [
            'overDueOrders' => $overDueOrders,
            'actualOrders' => $this->splitOrdersByGroups->configure($actualOrders, $this->orderStatus),
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
        $partners = $this->dispatch(new GetAllPartnersQuery);

        return view('order.edit', [
            'order' => $order,
            'orderStatuses' => $orderStatuses,
            'partners' => $partners
        ]);
    }

    /**
     * @param UpdateOrderRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateOrderRequest $request, int $id)
    {
        try {
            $order = $this->dispatch(new GetOrderByIdQuery($id));

            $this->dispatch(new UpdateOrderCommand($order, $request, $this->orderStatus));
        } catch (Exception $exception) {
            return redirect(route('orders.all'))->with('message', $exception->getMessage());
        }

        return redirect(route('orders.all'))->with('message', __('order.update.success'));
    }
}
