<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Mail\OrderCompletedSend;
use App\OrderProduct;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Mail;

class NotifyOrderComplete
{
    use DispatchesJobs;

    /**
     * @param OrderCompleted $orderCompleted
     */
    public function handle(OrderCompleted $orderCompleted): void
    {
        $partnerEmail = $orderCompleted->order->partner->email;
        $vendorEmails = $orderCompleted->order->orderProducts()->with('product.vendor')->get()->map(static function (OrderProduct $orderProduct) {
            return $orderProduct->product->vendor->email;
        });

        Mail::to($vendorEmails->merge($partnerEmail)->toArray())
            ->send(new OrderCompletedSend($orderCompleted->order));
    }
}
