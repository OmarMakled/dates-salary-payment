<?php

declare(strict_types=1);

namespace App\Services\Payments;

use DateTimeInterface;

final class Payment
{
    public function __construct(
        public readonly DateTimeInterface $month,
        public readonly DateTimeInterface $salaryPaymentDate,
        public readonly DateTimeInterface $bonusPaymentDate,
    ) {
    }
}
