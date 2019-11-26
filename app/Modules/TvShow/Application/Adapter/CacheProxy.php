<?php

namespace App\TvShow\Application\Adapter;

use DateInterval;

interface CacheProxy
{
    public function getFromCache(string $name): ?string;

    public function pushToCache(string $serializedObject, string $name, DateInterval $dateInterval): bool;
}
