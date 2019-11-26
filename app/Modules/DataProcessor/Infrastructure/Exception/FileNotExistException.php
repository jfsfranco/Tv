<?php

namespace App\DataProcessor\Infrastructure\Exception;

use RuntimeException;
use App\DataProcessor\Application\Exception\FileNotExistException as FileNotExistExceptionInterface;

class FileNotExistException extends RuntimeException implements FileNotExistExceptionInterface
{
    const MESSAGE = "File does not exist";
}
