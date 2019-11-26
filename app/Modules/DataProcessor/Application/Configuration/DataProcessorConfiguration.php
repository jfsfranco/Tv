<?php

namespace App\DataProcessor\Application\Configuration;

interface DataProcessorConfiguration
{
    public function getCSVDelimiter(): string;
}
