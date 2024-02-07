<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    #[Validate('required|email', message: 'Invalid email')]
    public $email = '';
    #[Validate('required|min:3|max:255')]
    public $name = '';
}
