<?php

namespace App\DataProcessor\Application\Exception;

use RuntimeException;

class InvalidDataException extends RuntimeException
{
    const MESSAGE = "Invalid data provided. Data no processed";
}
