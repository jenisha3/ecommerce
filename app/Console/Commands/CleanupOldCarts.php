<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CleanupOldCarts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cart:cleanup';

    /**
     * The console command description.
     */
    protected $description = 'Delete cart items older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $deleted = Cart::where('updated_at', '<', now()->subDays(7))->delete();

        $message = "{$deleted} old cart item(s) deleted.";

        $this->info($message);

        Log::info($message);

        return self::SUCCESS;
    }
}