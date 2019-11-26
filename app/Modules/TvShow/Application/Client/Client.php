<?php

namespace App\TvShow\Application\Client;

Interface Client
{
    public function result(string $tvShowName): string;
}
