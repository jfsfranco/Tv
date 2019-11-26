<?php

namespace App\DataProcessor\Infrastructure\Configuration;

use Codeception\PHPUnit\TestCase;
use App\Configuration\ConfigurationInterface;

class ConfigurationTest extends TestCase
{
    public function testGetCSVDelimiter()
    {
        $APIConfigurationMock = $this->createMock(ConfigurationInterface::class);
        $APIConfigurationMock->method("getCSVDelimiter")->willReturn(";");
        $configuration = new Configuration($APIConfigurationMock);
        $this->assertEquals(";", $configuration->getCSVDelimiter());
    }
}
