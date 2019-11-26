<?php

namespace App\TvShow\Infrastructure\Configuration;

use DateInterval;
use App\TvShow\Application\Configuration as ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /** @var DateInterval */
    private $cacheDuration;

    /** @var bool */
    private $cacheEnable;

    public function __construct(string $duration, bool $cacheEnable)
    {
        $this->cacheDuration = DateInterval::createFromDateString($duration);
        $this->cacheEnable = $cacheEnable;
    }

    public function getCacheDuration(): DateInterval
    {
        return $this->cacheDuration;
    }

    public function isCacheEnabled(): bool
    {
        return $this->cacheEnable;
    }
}
