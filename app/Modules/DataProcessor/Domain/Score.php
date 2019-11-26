<?php

namespace App\DataProcessor\Domain;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    const NAME_OF_SHOW = "name_of_show";
    const BRAND_FIT_SCORE = "brand_fit_score";
    const GENERATED_DATE = "generated_date";
}
