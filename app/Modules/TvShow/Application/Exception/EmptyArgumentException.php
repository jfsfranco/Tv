<?php

namespace App\TvShow\Application\Exception;

use InvalidArgumentException;

class EmptyArgumentException extends InvalidArgumentException
{
    const MESSAGE = "The tvshow can not be empty. Try with 'your_url/?q=tvshowTosearch'";

    public function getExceptionMessage(): string
    {
        return self::MESSAGE;
    }
}
