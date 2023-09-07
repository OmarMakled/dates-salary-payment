<?php

namespace Test\Unit\Services\Exporter\Types;

use App\Services\Exporter\Exceptions\ExporterException;
use PHPUnit\Framework\TestCase;
use App\Services\Exporter\Types\CsvExporter;
use App\Services\Exporter\ExporterFactory;

/**
 * @group unit
 */
class ExporterFactoryTest extends TestCase
{
    public function testCsvExporter(): void
    {
        $factory = new ExporterFactory();
        $exporter = $factory->create('foo.csv');
        self::assertInstanceOf(CsvExporter::class, $exporter);
    }

    public function testExporterExceptionCanOpen(): void
    {
        self::expectException(ExporterException::class);
        self::expectExceptionMessage('There is no exporter for the given file foo.txt');

        $factory = new ExporterFactory();
        $factory->create('foo.txt');
    }
}
