<?php

declare(strict_types=1);

namespace App\Services\Payments;

use Generator;
use DateTimeInterface;

final class PaymentManager
{
    public function __construct(
        private readonly PaymentInterface $salaryPayment,
        private readonly PaymentInterface $bonusPayment
    ) {
    }

    /**
     * @param Generator<DateTimeInterface>  $months
     * @return Generator<Payment>
     */
    public function generatePayments(Generator $months): Generator
    {
        foreach ($months as $month) {
            yield new Payment(
                $month,
                $this->salaryPayment->getPaymentDate($month),
                $this->bonusPayment->getPaymentDate($month),
            );
        }
    }
}
