<?php

declare(strict_types=1);

namespace App\Services\Payments;

use DateTimeInterface;

interface PaymentInterface
{
    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getPaymentDate(DateTimeInterface $date): DateTimeInterface;
}
