<?php

namespace App\TvShow\Application\ValueObject;

class Url
{
    /** @var string */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUrlWithQuery(string $query): string
    {
        return $this->url . $query;
    }
}
