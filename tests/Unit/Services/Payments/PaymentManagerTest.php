<?php

namespace Test\Unit\Services\Payments;

use App\Services\Payments\PaymentDate;
use App\Services\Payments\PaymentManager;
use App\Services\Payments\Types\BonusPayment;
use App\Services\Payments\Types\SalaryPayment;
use DateTime;
use PHPUnit\Framework\TestCase;

class PaymentManagerTest extends TestCase
{
    public function testGenerateNextMonths(): void
    {
        $paymentDate = new PaymentDate();
        $months = $paymentDate->generateNextMonths(
            new DateTime('2023-07'),
            3
        );
        $paymentManager = new PaymentManager(
            new SalaryPayment($paymentDate),
            new BonusPayment($paymentDate)
        );

        $expectedDates = [
            ["Jul", "2023-07-31", "2023-07-19"],
            ["Aug", "2023-08-31", "2023-08-15"],
            ["Sep", "2023-09-29", "2023-09-15"]
        ];
        $paymentDates = [];
        foreach ($paymentManager->generatePayments($months) as $payment) {
            $paymentDates[] = [
                $payment->month->format('M'),
                $payment->salaryPaymentDate->format('Y-m-d'),
                $payment->bonusPaymentDate->format('Y-m-d'),
            ];
        }
        self::assertEquals($expectedDates, $paymentDates);
    }
}
