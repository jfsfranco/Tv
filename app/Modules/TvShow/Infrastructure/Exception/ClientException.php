<?php

namespace App\TvShow\Infrastructure\Exception;

use App\TvShow\Application\Exception\ClientException as ClientExceptionInterface;
use ErrorException;

class ClientException extends ErrorException implements ClientExceptionInterface
{
    const NOT_FOUNT_MESSAGE = "TvShow Not Found";
    const EXTERNAL_ERROR_MESSAGE = "Problem connecting with external API";

    public function getNotFoundMessage(): string
    {
        return self::NOT_FOUNT_MESSAGE;
    }

    public function getExternalErrorMessage(): string
    {
        return self::EXTERNAL_ERROR_MESSAGE;
    }
}
