<?php

declare(strict_types=1);

namespace App\Services\Payments;

use App\Services\Payments\Exceptions\PaymentDateException;
use DateTimeInterface;
use Generator;
use Throwable;

final class PaymentDate implements PaymentDateInterface
{
    /**
     * @param DateTimeInterface $start
     * @param int $count
     * @return Generator
     */
    public function generateNextMonths(DateTimeInterface $start, int $count = 12): Generator
    {
        $current = clone $start;

        for ($i = 0; $i < $count; $i++) {
            yield $current;
            $current->modify('+1 month');
        }
    }

    /**
     * @param DateTimeInterface $date
     * @return bool
     */
    public function isWeekEnd(DateTimeInterface $date): bool
    {
        $dayOfWeek = (int) $date->format('N');

        return ($dayOfWeek === 6 || $dayOfWeek === 7);
    }


    /**
     * @param DateTimeInterface $date
     * @param string $dayOfWeek
     * @return DateTimeInterface
     * @throws PaymentDateException
     */
    public function getFirstDay(DateTimeInterface $date, string $dayOfWeek): DateTimeInterface
    {
        try {
            $firstDayOfWeek = clone $date;

            return $firstDayOfWeek->modify("next $dayOfWeek");
        } catch (Throwable $e) {
            throw new PaymentDateException('Invalid date ' . $e->getMessage());
        }
    }

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getLastFridayOfMonth(DateTimeInterface $date): DateTimeInterface
    {
        $endOfMonth = $this->getEndOfMonth($date);

        return $endOfMonth->modify('previous friday');
    }

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function get15thOfMonth(DateTimeInterface $date): DateTimeInterface
    {
        $firstOfMonth = $this->getFirstOfMonth($date);

        return $firstOfMonth->modify('+14 days');
    }

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getEndOfMonth(DateTimeInterface $date): DateTimeInterface
    {
        $endOfMonth = clone $date;

        return $endOfMonth->modify('last day of this month');
    }

    /**
     * @param DateTimeInterface $date
     * @return DateTimeInterface
     */
    public function getFirstOfMonth(DateTimeInterface $date): DateTimeInterface
    {
        $firstOfMonth = clone $date;

        return $firstOfMonth->modify('first day of this month');
    }
}
