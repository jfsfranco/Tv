<?php

namespace App\TvShow\Application;

use DateInterval;

interface Configuration
{
    public function getCacheDuration(): DateInterval;

    public function isCacheEnabled(): bool;
}
