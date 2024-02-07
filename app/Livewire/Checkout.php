<?php

namespace App\Livewire;

use App\Enums\CheckoutStepsEnum;
use App\Livewire\Forms\AddressForm;
use App\Livewire\Forms\UserForm;
use App\Services\CheckoutService;
use Livewire\Component;

class Checkout extends Component
{
    public array $cart = [];
    public int $step = CheckoutStepsEnum::SHIPPING->value;
    public int $method = 1;
    public UserForm $user;
    public AddressForm $address;

    public function mount(CheckoutService $checkoutService)
    {
        $this->cart = $checkoutService->loadCart();
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
}
