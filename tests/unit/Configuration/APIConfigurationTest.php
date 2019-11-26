<?php

namespace App\Configuration;

use Codeception\PHPUnit\TestCase;

class APIConfigurationTest extends TestCase
{
    /** @var APIConfiguration */
    private $apiConfiguration;

    protected function setUp(): void
    {
        $this->apiConfiguration = new APIConfiguration(
            "externalUrl",
            "5 minutes",
            true,
            ";"
        );
    }

    public function testGetExternalAPIUrl()
    {
        $this->assertEquals("externalUrl", $this->apiConfiguration->getExternalAPIUrl());
    }

    public function testGetCacheTime()
    {
        $this->assertEquals("5 minutes", $this->apiConfiguration->getCacheTime());
    }

    public function testIsCacheEnabled()
    {
        $this->assertEquals(true, $this->apiConfiguration->isCacheEnabled());
    }

    public function testGetCSVDelimiter()
    {
        $this->assertEquals(";", $this->apiConfiguration->getCSVDelimiter());
    }
}
