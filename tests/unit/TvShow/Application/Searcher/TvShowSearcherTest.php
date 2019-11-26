<?php

namespace App\TvShow\Application\Searcher;

use Codeception\PHPUnit\TestCase;
use stdClass;
use App\TvShow\Domain\TvShow;

class TvShowSearcherTest extends TestCase
{
    public function testSearch()
    {
        $tvShowExpected = new TvShow("Deadwood");
        $std = new stdClass();
        $std->show = new stdClass();
        $std->show->name = $tvShowExpected->getName();

        $tvShowSearcher = new TvShowSearcher();
        $tvShowRequested = $tvShowSearcher->search([$std], $tvShowExpected);

        $this->assertEquals($tvShowRequested->show->name, $tvShowExpected->getName());
    }
}
