<?php

namespace Test\Unit\Services\Payments\Types;

use App\Services\Payments\PaymentDate;
use App\Services\Payments\Types\BonusPayment;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class BonusPaymentTest extends TestCase
{
    public function testGetPaymentDate(): void
    {
        $bonusPayment = new BonusPayment(new PaymentDate());
        self::assertEquals(
            '2023-07-19',
            $bonusPayment->getPaymentDate(new DateTime('2023-07-01'))->format('Y-m-d')
        );
        self::assertEquals(
            '2022-07-15',
            $bonusPayment->getPaymentDate(new DateTime('2022-07-01'))->format('Y-m-d')
        );
    }
}
