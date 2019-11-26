<?php

namespace App\TvShow\Application\Factory;

use App\TvShow\Domain\TvShow;

interface TvShowFactoryInterface
{
    public function create(string $name): TvShow;
}
