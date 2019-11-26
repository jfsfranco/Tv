<?php

namespace App\TvShow\Application\Searcher;

use stdClass;
use App\TvShow\Domain\TvShow;

class TvShowSearcher implements TvShowSearcherInterface
{
    public function search(array $tvShowsList, TvShow $tvShowRequested): ?stdClass
    {
        $show = null;
        foreach ($tvShowsList as $retrievedTvShow) {
            if (!strcasecmp($retrievedTvShow->show->name, $tvShowRequested->getName())) {
                $show = $retrievedTvShow;
                continue;
            }
        }
        return $show;
    }
}
