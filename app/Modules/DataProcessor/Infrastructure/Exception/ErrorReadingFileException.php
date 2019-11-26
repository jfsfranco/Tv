<?php

namespace App\DataProcessor\Infrastructure\Exception;

use RuntimeException;
use App\DataProcessor\Application\Exception\ErrorReadingFileException as ErrorReadingFileExceptionInterface;

class ErrorReadingFileException extends RuntimeException implements ErrorReadingFileExceptionInterface
{
    const MESSAGE = "File can not be read";
}
