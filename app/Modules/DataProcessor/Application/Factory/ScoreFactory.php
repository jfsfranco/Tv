<?php

namespace App\DataProcessor\Application\Factory;

use App\DataProcessor\Application\Exception\InvalidDataException;
use App\DataProcessor\Domain\Score;

class ScoreFactory implements ScoreFactoryInterface
{
    public function create(?string $nameOfShow, ?int $brandFitScore, ?string $generateDate): Score
    {
        $this->guardAgainstInvalidValues($nameOfShow, $brandFitScore, $generateDate);
        $score = new Score();
        $score->setAttribute(Score::NAME_OF_SHOW, $nameOfShow);
        $score->setAttribute(Score::BRAND_FIT_SCORE, $brandFitScore);
        $score->setAttribute(Score::GENERATED_DATE, $generateDate);
        return $score;
    }

    private function guardAgainstInvalidValues(?string $nameOfShow, ?int $brandFitScore, ?string $generateDate): void
    {
        if ((!$nameOfShow) || !$brandFitScore || !$generateDate) {
            throw new InvalidDataException();
        }
        if (($brandFitScore < 0) || ($brandFitScore > 100)) {
            throw new InvalidDataException();
        }
    }
}
