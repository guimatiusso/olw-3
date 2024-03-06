<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class PaymentException extends Exception
{
    protected $message = 'Check the card data and try again.';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function render()
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
}
