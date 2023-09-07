<?php

declare(strict_types=1);

namespace App\Services\Payments\Types;

use App\Services\Payments\PaymentDateInterface;
use App\Services\Payments\PaymentInterface;
use DateTimeInterface;

final class BonusPayment implements PaymentInterface
{
    public function __construct(private readonly PaymentDateInterface $paymentDate)
    {
    }

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getPaymentDate(DateTimeInterface $date): DateTimeInterface
    {
        $paymentDate = $this->paymentDate->get15thOfMonth($date);

        if ($this->paymentDate->isWeekEnd($paymentDate)) {
            return $this->paymentDate->getFirstDay($paymentDate, 'Wednesday');
        }

        return $paymentDate;
    }
}
