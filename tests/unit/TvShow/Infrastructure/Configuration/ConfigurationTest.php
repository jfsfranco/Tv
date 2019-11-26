<?php

namespace App\TvShow\Infrastructure\Configuration;

use Codeception\PHPUnit\TestCase;
use DateInterval;

class ConfigurationTest extends TestCase
{
    /** @var Configuration */
    private $configuration;

    protected function setUp(): void
    {
        $this->configuration = new Configuration( "5 minutes", true);
    }

    public function testGetCacheTime()
    {
        $this->assertEquals(DateInterval::createFromDateString("5 minutes"), $this->configuration->getCacheDuration());
    }

    public function testIsCacheEnabled()
    {
        $this->assertEquals(true, $this->configuration->isCacheEnabled());
    }
}
