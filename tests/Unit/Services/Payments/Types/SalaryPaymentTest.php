<?php

namespace Test\Unit\Services\Payments\Types;

use App\Services\Payments\PaymentDate;
use App\Services\Payments\Types\SalaryPayment;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class SalaryPaymentTest extends TestCase
{
    public function testGetPaymentDate(): void
    {
        $salaryPayment = new SalaryPayment(new PaymentDate());
        self::assertEquals(
            '2022-07-29',
            $salaryPayment->getPaymentDate(new DateTime('2022-07-01'))->format('Y-m-d')
        );
        self::assertEquals(
            '2023-07-31',
            $salaryPayment->getPaymentDate(new DateTime('2023-07-01'))->format('Y-m-d')
        );
    }
}
