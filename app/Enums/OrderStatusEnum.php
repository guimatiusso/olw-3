<?php
namespace App\Enums;

enum OrderStatusEnum: int
{
    case CART = 1;
    case PENDING = 2;
    case PAID = 3;
    case CANCELED = 4;
    case REJECTED = 5;


    public function getName(): string
    {
        return match ($this) {
            self::CART => 'Cart',
            self::PENDING => 'Pending',
            self::PAID => 'Paid',
            self::CANCELED => 'Canceled',
            self::REJECTED => 'Rejected',
            default => 'Status not found'
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::CART => 'px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-800',
            self::PENDING => 'px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800',
            self::PAID => 'px-2 py-1 text-xs rounded-full bg-green-100 text-green-800',
            self::CANCELED => 'px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-800',
            self::REJECTED => 'Rejected',
            default => 'Status not found'
        };
    }
}
