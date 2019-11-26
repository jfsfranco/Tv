<?php

namespace App\DataProcessor\Infrastructure\Exception;

use App\DataProcessor\Application\Exception\InvalidFileFormatException as InvalidFileFormatExceptionInterface;
use RuntimeException;

class InvalidFileFormatException extends RuntimeException implements InvalidFileFormatExceptionInterface
{
    const MESSAGE = "The columns has not correct format";
}
