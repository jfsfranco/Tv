<?php

namespace App\TvShow\Application\Query;

use Codeception\PHPUnit\TestCase;

class TvShowQueryTest extends TestCase
{
    public function testGameName()
    {
        $query = new TvShowQuery("name");
        $this->assertEquals("name", $query->getName());
    }
}
