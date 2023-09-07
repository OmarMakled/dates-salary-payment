<?php

declare(strict_types=1);

namespace App\Services\Payments;

use App\Services\Payments\Exceptions\PaymentDateException;
use DateTimeInterface;
use Generator;

interface PaymentDateInterface
{
    /**
     * @param DateTimeInterface $start
     * @param int $count
     * @return Generator
     */
    public function generateNextMonths(DateTimeInterface $start, int $count = 12): Generator;

    /**
     * @param DateTimeInterface $date
     * @return bool
     */
    public function isWeekEnd(DateTimeInterface $date): bool;

    /**
     * @param DateTimeInterface $date
     * @param string $dayOfWeek
     * @return DateTimeInterface
     * @throws PaymentDateException
     */
    public function getFirstDay(DateTimeInterface $date, string $dayOfWeek): DateTimeInterface;

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getLastFridayOfMonth(DateTimeInterface $date): DateTimeInterface;

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function get15thOfMonth(DateTimeInterface $date): DateTimeInterface;

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getEndOfMonth(DateTimeInterface $date): DateTimeInterface;

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getFirstOfMonth(DateTimeInterface $date): DateTimeInterface;
}
