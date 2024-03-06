<?php
namespace App\Enums;

enum PaymentMethodEnum: int
{
    case CREDIT_CARD = 1;
    case PIX = 2;
    case BANK_SLIP = 3;

    public function getName(): string
    {
        return match ($this) {
            self::CREDIT_CARD => 'Credit Card',
            self::PIX => 'Pix',
            self::BANK_SLIP => 'Bank Slip',
            default => 'Method not found'
        };
    }

    public static function parse($method_name)
    {
        return match ($method_name) {
            'credit_card' => self::CREDIT_CARD,
            'bank_transfer' => self::PIX,
            'ticket' => self::BANK_SLIP,
            default => null,
        };
    }
}
