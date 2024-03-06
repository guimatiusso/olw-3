<?php

namespace App\Enums;
enum PaymentStatusEnum: int
{
    case PENDING = 1;
    case PAID = 2;
    case REJECTED = 3;
    case AUTHORIZED = 4;
    case IN_PROCESS = 5;
    case IN_MEDIATION = 6;
    case CHARGED_BACK = 7;
    case REFUNDED = 8;
    case CANCELLED = 9;


    public function getName() {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PAID => 'Paid',
            self::REJECTED => 'Rejected',
            self::AUTHORIZED => 'Authorized',
            self::IN_PROCESS => 'In process',
            self::IN_MEDIATION => 'In mediation',
            self::CHARGED_BACK => 'Charge Back',
            self::REFUNDED => 'Refunded',
            self::CANCELLED => 'Cancelled',
            default => 'Status not found'
        };
    }

    public function getStyles(): string
    {
        return match ($this) {
            self::PENDING => 'px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800',
            self::PAID => 'px-2 py-1 r text-xs rounded-full bg-green-100 text-green-800',
            self::REJECTED => 'px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-800',
            self::AUTHORIZED => 'px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800',
            self::IN_PROCESS => 'px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800',
            self::IN_MEDIATION => 'px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800',
            self::CHARGED_BACK => 'px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-800',
            self::REFUNDED => 'px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-800',
            self::CANCELLED => 'px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-800',
            default => ''
        };
    }

    public static function parse($status) {
        return match ($status) {
            'pending' => self::PENDING,
            'approved' => self::PAID,
            'rejected' => self::REJECTED,
            'authorized' => self::AUTHORIZED,
            'in_process' => self::IN_PROCESS,
            'in_mediation' => self::IN_MEDIATION,
            'charged_back' => self::CHARGED_BACK,
            'cancelled' => self::CANCELLED,
            'refunded' => self::REFUNDED,
            default => null,
        };
    }
}
