<?php

namespace App\Livewire;

use App\Enums\CheckoutStepsEnum;
use App\Exceptions\PaymentException;
use App\Livewire\Forms\AddressForm;
use App\Livewire\Forms\UserForm;
use App\Services\CheckoutService;
use App\Services\OrderService;
use App\Services\UserService;
use Livewire\Component;

class Checkout extends Component
{
    public array $cart = [];
    public int $step = CheckoutStepsEnum::PAYMENT->value;
    public int|null $method = null;
    public UserForm $user;
    public AddressForm $address;

    public function mount(CheckoutService $checkoutService)
    {
        $this->cart = $checkoutService->loadCart();
        $this->user->email = config('payment.mercadopago.buyer_email');
    }

    public function render()
    {
        return view('livewire.checkout');
    }

    public function submitInformation()
    {
        $this->validate();
        $this->step = CheckoutStepsEnum::SHIPPING->value;
    }

    public function submitShipping()
    {
        $this->step = CheckoutStepsEnum::PAYMENT->value;
    }

    public function findAddress()
    {
        $this->address->findAddress();
    }

    public function creditCardPayment(CheckoutService $checkoutService, $data)
    {
        try {
            $payment = $checkoutService->creditCardPayment($data, $this->user->all(), $this->address->all());
        } catch (PaymentException $e) {
            $this->addError('payment', $e->getMessage());
        } catch (\Exception $e) {
            $this->addError('payment', $e->getMessage());
        }
    }

    public function pixOrBankSlipPayment(
        CheckoutService $checkoutService,
        UserService $userService,
        OrderService $orderService,
        $data
    )
    {
        try {
            $payment = $checkoutService->pixOrBankSlipPayment($data, $this->user->all(), $this->address->all());
            $user = $userService->store($this->user->all(), $this->address->all());
            $order = $orderService->update($this->cart['id'], $payment, $user, $this->address->all());
        } catch (PaymentException $e) {
            $this->addError('payment', $e->getMessage());
        } catch (\Exception $e) {
            $this->addError('payment', $e->getMessage());
        }
    }
}
