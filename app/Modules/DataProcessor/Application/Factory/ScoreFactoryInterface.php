<?php


namespace App\DataProcessor\Application\Factory;

use App\DataProcessor\Domain\Score;

interface ScoreFactoryInterface
{
    public function create(?string $nameOfShow, ?int $brandFitScore, ?string $generateDate): Score;
}
