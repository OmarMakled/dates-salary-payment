<?php

namespace Test\Unit\Services\Exporter\Types;

use App\Services\Exporter\Exceptions\ExporterException;
use PHPUnit\Framework\TestCase;
use App\Services\Exporter\Types\CsvExporter;

/**
 * @group unit
 */
class CsvExporterTest extends TestCase
{
    public function testExport(): void
    {
        $data = [['h1', 'h2'],[1, 2], [1, 2], [1]];
        $filename = __DIR__ . '/test_csv.csv';

        $csvExporter = new CsvExporter();
        $csvExporter->export($data, $filename);

        $this->assertFileExists($filename);
        unlink($filename);
    }

    public function testExporterExceptionInvalidFileName(): void
    {
        $this->expectException(ExporterException::class);
        $this->expectExceptionMessage('Failed to write file: /');

        $parser = new CsvExporter();
        $parser->export([], '/');
    }

    public function testExporterExceptionInvalidData(): void
    {
        $filename = __DIR__ . '/test_csv.csv';
        $this->expectException(ExporterException::class);
        $this->expectExceptionMessage('Failed to write file: invalid data');

        $parser = new CsvExporter();
        $parser->export(['foo', 'bar'], $filename);
    }
}
