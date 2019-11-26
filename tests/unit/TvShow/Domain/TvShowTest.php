<?php

namespace App\TvShow\Domain;

use Codeception\PHPUnit\TestCase;

class TvShowTest extends TestCase
{
    public function testGetName()
    {
        $tvShow = new TvShowTest("Deadwood");
        $this->assertEquals("Deadwood", $tvShow->getName());
    }
}
