<?php

namespace App\TvShow\Application\Searcher;

use App\TvShow\Domain\TvShow;
use stdClass;

interface TvShowSearcherInterface
{
    public function search(array $tvShowsList, TvShow $tvShowRequested): ?stdClass;
}
