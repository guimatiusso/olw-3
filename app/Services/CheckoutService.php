<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Database\Seeders\OrderSeeder;
use function Laravel\Prompts\confirm;

class CheckoutService
{
    public function loadCart(): array
    {
        $cart = Order::with('skus.product', 'skus.features')
            ->where('status', OrderStatusEnum::CART)
            ->where(function ($query) {
                $query->where('session_id', session()->getId());
                if (auth()->check()) {
                    $query->orWhere('user_id', auth()->user()->id);
                }
            })->first();

        if (!$cart && config('app.env') == 'local') {
            $seeder = new OrderSeeder();
            $seeder->run(session()->getId());
            return $this->loadCart();
        }

        return $cart->toArray();
    }
}
