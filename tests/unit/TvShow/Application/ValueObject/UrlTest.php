<?php

namespace App\TvShow\Application\ValueObject;

use Codeception\PHPUnit\TestCase;

class UrlTest extends TestCase
{
    public function testGetUrlWithQuery()
    {
        $url = new Url("google.es");
        $this->assertEquals("google.es/?query", $url->getUrlWithQuery("/?query"));
    }
}
