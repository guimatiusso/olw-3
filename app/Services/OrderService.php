<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;

class OrderService
{
    public function update($order_id, $payment, $user, $address): Order
    {
        $order = Order::find($order_id);
        $order->user_id = $user->id;
        $order->status = OrderStatusEnum::parse($payment->status);
        $order->save();

        $order->payment()->create([
            'external_id' => $payment->id,
            'method' => $payment->payment_type_id,
            'status' => $payment->status,
            'installments' => $payment->installments,
            'approved_at' => $payment->date_approved ?? null,
            'qr_code_64' => $payment?->points_of_interaction?->transaction_data?->qr_code_base64 ?? null,
            'qr_code' => $payment?->points_of_interaction?->transaction_data?->qr_code_base ?? null,
            'ticket_url' => $payment?->points_of_interaction?->transaction_data?->ticket_url ?? $payment?->transaction_details?->external_resource_url
        ]);

        $order->shipping()->create([
            'address' => $address['address'],
            'number' => $address['number'],
            'complement' => $address['complement'],
            'district' => $address['district'],
            'city' => $address['city'],
            'state' => $address['state'],
            'zipcode' => $address['zipcode'],
        ]);

        $order->load(['payments', 'shippings']);

        return $order;
    }
}
