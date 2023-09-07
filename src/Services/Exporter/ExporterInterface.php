<?php

declare(strict_types=1);

namespace App\Services\Exporter;

interface ExporterInterface
{
    /**
     * @param array $data
     * @param string $filename
     * @return void
     */
    public function export(array $data, string $filename): void;
}
