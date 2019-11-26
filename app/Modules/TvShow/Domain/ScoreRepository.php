<?php

namespace App\TvShow\Domain;

interface ScoreRepository
{
    public function findOneByName(string $name): ?Score;
}
