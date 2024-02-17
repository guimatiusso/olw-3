<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Exceptions\PaymentException;
use App\Models\Order;
use Database\Seeders\OrderSeeder;
use Illuminate\Support\Str;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use function Laravel\Prompts\confirm;

class CheckoutService
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('payment.mercadopago.access_token'));
    }
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

    public function creditCardPayment($data, $user, $address)
    {
        $client = new PaymentClient();
        $payment = $client->create([
            "transaction_amount" => (float) $data['transaction_amount'],
            "token" => $data['token'],
            "description" => $data['description'],
            "installments" => $data['installments'],
            "payment_method_id" => $data['payment_method_id'],
            "issuer_id" => $data['issuer_id'],
            "payer" => $this->buildPayer($user, $address)
        ]);

        throw_if(
            !$payment->id || $payment->status === 'rejected',
            PaymentException::class,
                $payment?->error?->message ?? 'Verifique os dados do cartão'
        );

        return $payment;
    }

    public function pixOrBankSlipPayment($data, $user, $address)
    {
        $client = new PaymentClient();
        $payment = $client->create([
            "transaction_amount" => (float) $data['amount'],
            "description" => 'Product Title',
            "payment_method_id" => $data['method'],
            "payer" => $this->buildPayer($user, $address)
        ]);

        throw_if(
            !$payment->id || $payment->status === 'rejected',
            PaymentException::class,
            $payment?->error?->message ?? 'Verifique os dados do cartão'
        );

        return $payment;
    }

    public function buildPayer($user, $adress)
    {
        $first_name = explode(' ', $user['name'])[0];
        return [
            "email" => $user['email'],
            "first_name" => $first_name,
            "last_name" => Str::of($user['name'])->after($first_name)->trim(),
            "identification" => [
                "type" => 'CPF',
                "number" => $user['cpf']
            ],
            'address' => [
                'street_name' => $adress['street'],
                'street_number' => $adress['number'],
                'zip_code' => $adress['zipcode'],
                'neighborhood' => $adress['district'],
                'city' => $adress['city'],
                'federal_unit' => $adress['state'],
            ]
        ];
    }
}
