<?php

namespace App\DataProcessor\Application\Command;

use Codeception\PHPUnit\TestCase;

class CreateScoresFromCsvCommandTest extends TestCase
{
    public function testGetFileName()
    {
        $createScoresFromCsvCommand = new CreateScoresFromCsvCommand("fileUrl");
        $this->assertEquals("fileUrl", $createScoresFromCsvCommand->getFileName());
    }
}
