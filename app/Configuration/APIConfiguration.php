<?php

namespace App\Configuration;

class APIConfiguration implements ConfigurationInterface
{
    /** @var string */
    private $externalAPIUrl;

    /** @var string */
    private $cacheTime;

    /** @var bool */
    private $cacheEnabled;

    /** @var string */
    private $delimiter;

    public function __construct(
        string $externalAPIUrl,
        string $cacheTime,
        bool $cacheEnabled,
        string $delimiter
    ) {
        $this->externalAPIUrl = $externalAPIUrl;
        $this->cacheTime = $cacheTime;
        $this->cacheEnabled = $cacheEnabled;
        $this->delimiter = $delimiter;
    }

    public function getExternalAPIUrl(): string
    {
        return $this->externalAPIUrl;
    }

    public function getCacheTime(): string
    {
        return $this->cacheTime;
    }

    public function isCacheEnabled(): bool
    {
        return $this->cacheEnabled;
    }

    public function getCSVDelimiter(): string
    {
        return $this->delimiter;
    }
}
