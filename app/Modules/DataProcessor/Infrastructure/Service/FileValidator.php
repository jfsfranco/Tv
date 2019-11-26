<?php

namespace App\DataProcessor\Infrastructure\Service;

use App\DataProcessor\Application\Service\FileValidator as FileValidatorInterface;
use App\DataProcessor\Infrastructure\Exception\InvalidFileExtension;
use App\DataProcessor\Infrastructure\Exception\ErrorReadingFileException;
use App\DataProcessor\Infrastructure\Exception\FileNotExistException;

class FileValidator implements FileValidatorInterface
{
    public function checkIfFilesAreValid(array $files)
    {
        foreach ($files as $file) {
            $this->guardAgainstInvalidExtension($file->getClientOriginalExtension());
            $this->guardAgainstInvalidFile($file->getPathname());
        }
    }

    private function guardAgainstInvalidExtension(string $extension): void
    {
        if ($extension != "csv") {
            throw new InvalidFileExtension();
        }
    }

    private function guardAgainstInvalidFile(string $filename): void
    {
        if (!file_exists($filename)) {
            throw new FileNotExistException();
        }
        if (!is_readable($filename)) {
            throw new ErrorReadingFileException();
        }
    }
}
