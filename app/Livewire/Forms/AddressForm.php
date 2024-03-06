<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AddressForm extends Form
{
    #[Validate('required|string|max:9')]
    public $zipcode = '';

    #[Validate('required|string|max:255')]
    public $address = '';

    #[Validate('required|string|max:2')]
    public $state = '';

    #[Validate('required|string|max:255')]
    public $city = '';

    #[Validate('required|string|max:255')]
    public $district = '';

    #[Validate('required|string|max:255')]
    public $number = '';

    #[Validate('nullable|string|max:255')]
    public $complement = '';

    public function findAddress()
    {
        $zipcode = preg_replace('/[^0-9]/im', '', $this->zipcode);
        $url = "https://viacep.com.br/ws/{$zipcode}/json/";
        $address = Http::get($url)->object();

        if (!$address || (isset($address->erro) && $address->erro)) {
            $this->addError('address', 'Address not found');
            return;
        }

        $this->address = $address->logradouro;
        $this->state = $address->uf;
        $this->city = $address->localidade;
        $this->district = $address->bairro;
    }
}
