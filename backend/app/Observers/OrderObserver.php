<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\NewOrderNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $users = User::where('role', \App\Enums\UserRole::SUPER_ADMIN)->get();
        Notification::send($users, new NewOrderNotification($order));
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        if ($order->isDirty('status')) {
            $order->orderLogs()->create([
                'action'      => "updated",
                'attribute'   => "status",
                'old_value'   => $order->getOriginal('status'),
                'new_value'   => $order->status,
                'description' => "Order status changed from " . Str::upper($order->getOriginal('status')) . " to " . Str::upper($order->status),
            ]);
        }
    }
}