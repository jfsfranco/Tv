<?php

namespace App\TvShow\Application\Decorator;

use stdClass;

class ResponseDecorator implements ResponseDecoratorInterface
{
    public function addToResponse(stdClass $response, string $key, ?string $value): stdClass
    {
        $response->$key = $value;
        return $response;
    }
}
