<?php

namespace App\TvShow\Infrastructure\Adapter;

use App\TvShow\Application\Adapter\CacheProxy as CacheProxyInterface;
use DateInterval;
use Illuminate\Support\Facades\Cache;

class CacheProxy implements CacheProxyInterface
{
    /** @var bool */
    private $cacheEnabled;

    /** @var Cache */
    private $cache;

    public function __construct(bool $cacheEnabled)
    {
        $this->cacheEnabled = $cacheEnabled;
    }

    public function getFromCache(string $name): ?string
    {
        if (!$this->cacheEnabled) {
            return null;
        }
        return Cache::get($name);
    }

    public function pushToCache(string $serializedObject, string $name, DateInterval $dateInterval): bool
    {
        if (!$this->cacheEnabled) {
            return false;
        }
        return Cache::put($name, $serializedObject, $dateInterval);
    }
}
