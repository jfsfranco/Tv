<?php

namespace App\Configuration;

interface ConfigurationInterface
{
    public function getExternalAPIUrl(): string;

    public function getCacheTime(): string;

    public function isCacheEnabled(): bool;

    public function getCSVDelimiter(): string;
}
