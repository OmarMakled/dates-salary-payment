#!/usr/bin/env php
<?php

use App\Services\Payments\PaymentDate;
use App\Services\Payments\PaymentManager;
use App\Services\Exporter\ExporterFactory;
use App\Services\Payments\Types\BonusPayment;
use App\Services\Payments\Types\SalaryPayment;

require_once __DIR__ . '/../../vendor/autoload.php';
$filename = __DIR__ . '/../../dist/' . $argv[1];

// Generate payment dates of the next 12 months start from current month
$paymentDate = new PaymentDate();
$paymentMonths = $paymentDate->generateNextMonths(new DateTime(date('Y-m')));
$paymentManager = new PaymentManager(
    new SalaryPayment($paymentDate),
    new BonusPayment($paymentDate)
);
$paymentDates = [];
foreach ($paymentManager->generatePayments($paymentMonths) as $payment) {
    $paymentDates[] = [
        $payment->month->format('M'),
        $payment->salaryPaymentDate->format('Y-m-d'),
        $payment->bonusPaymentDate->format('Y-m-d'),
    ];
}

// Export the payment dates along with the header row using the exporter factory
$exporter = (new ExporterFactory())->create($filename);
$exporter->export(
    [['month name', 'salary payment date', 'bonus payment date'], ...$paymentDates],
    $filename
);
