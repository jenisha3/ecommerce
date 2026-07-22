<?php

namespace App\Jobs;

use App\Mail\OrderPlacedMail;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendOrderEmailJob implements ShouldQueue
{
    use Queueable; 

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        Mail::to($this->order->email)
            ->send(new OrderPlacedMail($this->order));
    }
}