<?php

namespace App\TvShow\Infrastructure\Repository;

use App\TvShow\Domain\ScoreRepository;
use App\TvShow\Domain\Score;
use Illuminate\Database\Eloquent\Model;

class ScoreEloquentRepository implements ScoreRepository
{
    /** @var Score */
    private $score;

    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    public function findOneByName(string $name): ?Score
    {
        return $this->score->where('name_of_show', $name)->latest('generated_date')->first();
        /** @var Model */
//        return Score::where('name_of_show', $name)->latest('generated_date')->first();
    }
}
