<?php

namespace App\TvShow\Application\Factory;

use Codeception\PHPUnit\TestCase;

class TvShowFactoryTest extends TestCase
{
    public function testCreate()
    {
        $tvShowFactory = new TvShowFactory();
        $tvShow = $tvShowFactory->create("The Lord Of The Ring");
        $this->assertEquals("The Lord Of The Ring", $tvShow->getName());
    }
}
