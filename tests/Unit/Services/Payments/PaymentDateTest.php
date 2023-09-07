<?php

namespace Test\Unit\Services\Payments;

use App\Services\Payments\Exceptions\PaymentDateException;
use DateTime;
use PHPUnit\Framework\TestCase;
use App\Services\Payments\PaymentDate;

/**
 * @group unit
 */
class PaymentDateTest extends TestCase
{
    public function testGenerateNextMonths(): void
    {
        $dt = new PaymentDate();
        $months = $dt->generateNextMonths(new DateTime('2023-07-01'));
        $expectedMonths = [
            '2023-07-01',
            '2023-08-01',
            '2023-09-01',
            '2023-10-01',
            '2023-11-01',
            '2023-12-01',
            '2024-01-01',
            '2024-02-01',
            '2024-03-01',
            '2024-04-01',
            '2024-05-01',
            '2024-06-01',
        ];
        $actualMonths = [];
        foreach ($months as $month) {
            $actualMonths[] = $month->format('Y-m-d');
        }

        self::assertEquals($expectedMonths, $actualMonths);
    }

    public function testIsWeekEnd(): void
    {
        $paymentDate = new PaymentDate();
        self::assertTrue($paymentDate->isWeekEnd(new DateTime('2022-07-31')));
        self::assertFalse($paymentDate->isWeekEnd(new DateTime('2023-07-31')));
    }

    public function testGetFirstDay(): void
    {
        $paymentDate = new PaymentDate();
        self::assertEquals(
            '2023-07-05',
            $paymentDate->getFirstDay(new DateTime('2023-07-01'), 'Wednesday')
                ->format('Y-m-d')
        );

        self::expectException(PaymentDateException::class);
        self::expectExceptionMessage('Invalid date');
        self::assertEquals(
            '2023-07-05',
            $paymentDate->getFirstDay(new DateTime('2023-07-01'), 'Foo')
                ->format('Y-m-d')
        );
    }

    public function testGet15thOfMonth(): void
    {
        $paymentDate = new PaymentDate();
        self::assertEquals(
            '2022-07-15',
            $paymentDate->get15thOfMonth(new DateTime('2022-07-01'))->format('Y-m-d')
        );
    }

    public function testGetEndOfMonth(): void
    {
        $paymentDate = new PaymentDate();
        self::assertEquals(
            '2022-07-31',
            $paymentDate->getEndOfMonth(new DateTime('2022-07-01'))->format('Y-m-d')
        );
    }

    public function testGetFirstOfMonth(): void
    {
        $paymentDate = new PaymentDate();
        self::assertEquals(
            '2022-07-01',
            $paymentDate->getFirstOfMonth(new DateTime('2022-07-15'))->format('Y-m-d')
        );
    }

    public function testGetLastFridayOfMonth(): void
    {
        $paymentDate = new PaymentDate();
        self::assertEquals(
            '2022-07-29',
            $paymentDate->getLastFridayOfMonth(new DateTime('2022-07-01'))->format('Y-m-d')
        );
        self::assertEquals(
            '2023-07-28',
            $paymentDate->getLastFridayOfMonth(new DateTime('2023-07-01'))->format('Y-m-d')
        );
    }
}
