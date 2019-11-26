<?php

namespace App\DataProcessor\Infrastructure\Repository;

use App\DataProcessor\Domain\Repository\ScoreRepository;
use App\DataProcessor\Domain\Score;
use ArrayObject;

class ScoreEloquentRepository implements ScoreRepository
{
    public function persistCollection(ArrayObject $scores)
    {
        /** @var Score $score */
        foreach ($scores as $score) {
            $score->save();
        }
    }
}
