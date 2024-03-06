<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Mail\PaymentApprovedMail;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment as MPPayment;

class PaymentService
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('payment.mercadopago.access_token'));
    }

    public function update($external_id): Order
    {
        $mercadoPagoPayment = new MPPayment\PaymentClient();
        $mp_payment = $mercadoPagoPayment->get($external_id);
        $payment = Payment::with('order.user')->where('external_id', $external_id)->findOrFail();

        $payment->status = PaymentStatusEnum::parse($mp_payment->status);
        $payment->save();

        if ($payment->status == PaymentStatusEnum::PAID) {
            $payment->approved_at = $mp_payment->date_approved;
            $payment->order->status = OrderStatusEnum::PAID->value;
            $payment->order->save();

            Mail::to($payment->order->user->email)->queue(new PaymentApprovedMail($payment->order));
        }

        if ($payment->status === PaymentStatusEnum::CANCELLED || $payment->status === PaymentStatusEnum::REJECTED)
        {
            $payment->order->status = OrderStatusEnum::parse($mp_payment->status);
            $payment->order->save();
        }
    }
}
