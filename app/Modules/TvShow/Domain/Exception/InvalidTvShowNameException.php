<?php

namespace App\TvShow\Domain\Exception;

use InvalidArgumentException;

class InvalidTvShowNameException extends InvalidArgumentException
{
    const MESSAGE = "Wrong TvShow name Given";

    public function getExceptionMessage(): string
    {
        return self::MESSAGE;
    }
}
