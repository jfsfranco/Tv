<?php

namespace App\TvShow\Domain;

use App\TvShow\Domain\Exception\InvalidTvShowNameException;

class TvShow
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
