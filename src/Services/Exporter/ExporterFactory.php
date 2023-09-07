<?php

declare(strict_types=1);

namespace App\Services\Exporter;

use App\Services\Exporter\Exceptions\ExporterException;
use App\Services\Exporter\Types\CsvExporter;

final class ExporterFactory
{
    /**
     * @param string $filename
     * @return ExporterInterface
     * @throws ExporterException
     */
    public static function create(string $filename): ExporterInterface
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return match ($extension) {
            'csv' => new CsvExporter(),
            default => throw new ExporterException(
                'There is no exporter for the given file ' . $filename
            ),
        };
    }
}
