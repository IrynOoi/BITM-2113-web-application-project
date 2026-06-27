<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class AutoProgressOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:auto-progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically progress orders to the next status every 30 seconds';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting auto-progression of orders. Press Ctrl+C to exit.');

        $transitions = [
            'pending' => 'confirmed',
            'confirmed' => 'preparing',
            'preparing' => 'ready',
            'ready' => 'completed',
        ];

        while (true) {
            $now = Carbon::now();
            
            // Find orders where updated_at is older than 30 seconds
            // and status is one of the keys in transitions
            $orders = Order::whereIn('status', array_keys($transitions))
                           ->where('updated_at', '<=', $now->subSeconds(30))
                           ->get();

            if ($orders->count() > 0) {
                foreach ($orders as $order) {
                    $oldStatus = $order->status;
                    $newStatus = $transitions[$oldStatus];
                    $order->status = $newStatus;
                    // Note: saving the order updates the 'updated_at' timestamp automatically
                    $order->save();
                    
                    $this->info('[' . date('Y-m-d H:i:s') . "] Order #{$order->id} progressed from {$oldStatus} to {$newStatus}");
                }
            }

            // Sleep for a short while before checking again
            sleep(5);
        }
    }
}
