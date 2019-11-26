<?php

namespace App\DataProcessor\Domain\Repository;

use ArrayObject;

interface ScoreRepository
{
    public function persistCollection(ArrayObject $scores);
}
