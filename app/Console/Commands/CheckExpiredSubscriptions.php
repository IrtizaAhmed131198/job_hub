<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class CheckExpiredSubscriptions extends Command
{
    protected $signature = 'subscriptions:check-expired';
    protected $description = 'Check for expired subscriptions and update order status and user subscription accordingly';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get current date
        $now = Carbon::now();

        // Fetch all active orders
        $orders = Order::where('status', '!=', 'cancelled')->get();

        foreach ($orders as $order) {
            $subscriptionEndDate = null;

            // Determine the subscription end date based on the subscription plan
            if ($order->subscription_box === 'Standard') {
                $subscriptionEndDate = Carbon::parse($order->order_date)->addDays(14);
            } elseif ($order->subscription_box === 'Premium') {
                $subscriptionEndDate = Carbon::parse($order->order_date)->addYear();
            } elseif ($order->subscription_box === 'Enterprise') {
                $subscriptionEndDate = Carbon::parse($order->order_date)->addMonths(3);
            }

            // Check if the subscription has expired
            if ($subscriptionEndDate && $now->greaterThan($subscriptionEndDate)) {
                // Update order status to 'cancelled'
                $order->status = 'cancelled';
                $order->update();

                // Clear the subscription plan in the user's table
                $user = User::where('id', $order->user_id)->first();
                $user->subscription_plan = null;
                $user->update();

                $this->info('Subscription expired for user ID: ' . $order->user_id . ' and order ID: ' . $order->id);
            }
        }

        $this->info('Expired subscription check completed successfully.');
    }
}
