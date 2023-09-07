<?php

declare(strict_types=1);

namespace App\Services\Exporter\Types;

use App\Services\Exporter\Exceptions\ExporterException;
use App\Services\Exporter\ExporterInterface;
use Throwable;

final class CsvExporter implements ExporterInterface
{
    /**
     * @param array $data
     * @param string $filename
     * @return void
     * @throws ExporterException
     */
    public function export(array $data, string $filename): void
    {
        if (!($file = @fopen($filename, 'w'))) {
            throw new ExporterException("Failed to write file: $filename");
        }
        try {
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        } catch (Throwable $e) {
            throw new ExporterException('Failed to write file: invalid data ' . $e->getMessage());
        }
    }
}
