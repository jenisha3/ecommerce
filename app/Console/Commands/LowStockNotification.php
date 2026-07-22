<?php

namespace App\Console\Commands;

use App\Mail\LowStockNotificationMail;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class LowStockNotification extends Command
{
    protected $signature = 'stock:check';

    protected $description = 'Check products with low stock';

    public function handle(): int
    {
        $products = Product::where('stock', '<=', 5)->get();

        if ($products->isEmpty()) {

            $this->info('No low stock products found.');

            return self::SUCCESS;
        }

        Mail::to('admin@gmail.com')
            ->send(new LowStockNotificationMail($products));

        $this->info('Low stock email sent successfully.');

        return self::SUCCESS;
    }
}