<?php

namespace App\TvShow\Application\Decorator;

use stdClass;

interface ResponseDecoratorInterface
{
    public function addToResponse(stdClass $response, string $key, ?string $value): stdClass;
}
