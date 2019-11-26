<?php

namespace App\TvShow\Application\Factory;

use App\TvShow\Domain\TvShow;

class TvShowFactory implements TvShowFactoryInterface
{
    public function create(string $name): TvShow
    {
        return new TvShow($name);
    }
}
