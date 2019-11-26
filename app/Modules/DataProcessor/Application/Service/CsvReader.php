<?php

namespace App\DataProcessor\Application\Service;

interface CsvReader
{
    public function createScoresFromCsv(string $file, string $delimiter);
}
