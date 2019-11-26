<?php

namespace App\DataProcessor\Infrastructure\Exception;

use App\DataProcessor\Application\Exception\InvalidFileException;
use RuntimeException;

class InvalidFileExtension extends RuntimeException implements InvalidFileException
{
    const MESSAGE = "The submitted file(s) has wrong extension";
}
