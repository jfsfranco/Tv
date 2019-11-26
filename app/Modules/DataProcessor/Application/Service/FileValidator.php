<?php

namespace App\DataProcessor\Application\Service;

interface FileValidator
{
    public function checkIfFilesAreValid(array $files);
}
