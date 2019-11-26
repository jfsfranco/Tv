<?php

namespace App\TvShow\Domain;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    const BRAND_FIT_SCORE = "brand_fit_score";

    public function getScore(): ?string
    {
        return $this->getAttribute(self::BRAND_FIT_SCORE);
    }
}
