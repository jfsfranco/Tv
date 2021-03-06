<?php

namespace App\DataProcessor\Application\Command;

class CreateScoresFromCsvCommand
{
    /** @var string */
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}
