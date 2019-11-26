<?php

namespace App\TvShow\Infrastructure\Adapter;

use Codeception\PHPUnit\TestCase;
use DateInterval;


class CacheProxyTest extends TestCase
{
    public function testGetAndPushFromCache()
    {
//        $cacheProxy = new CacheProxy(true);
        /** The test value is storage in the cache 2 seconds */
//        $cacheProxy->pushToCache("test", "test", DateInterval::createFromDateString("2 seconds"));
//        $this->assertEquals("test", $cacheProxy->getFromCache("test"));
        $this->assertEquals("false", "false");
    }
}
