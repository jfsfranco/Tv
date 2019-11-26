<?php

namespace App\DataProcessor\Infrastructure\Configuration;

use App\Configuration\APIConfiguration;
use App\Configuration\ConfigurationInterface;
use App\DataProcessor\Application\Configuration\DataProcessorConfiguration;

class Configuration implements DataProcessorConfiguration
{
    /** @var APIConfiguration */
    private $APIConfiguration;

    public function __construct(ConfigurationInterface $APIConfiguration)
    {
        $this->APIConfiguration = $APIConfiguration;
    }

    public function getCSVDelimiter(): string
    {
        return $this->APIConfiguration->getCSVDelimiter();
    }
}
