<?php

namespace App\DataProcessor\Application\CommandHandler;

use App\DataProcessor\Application\Command\CreateScoresFromCsvCommand;
use App\DataProcessor\Application\Configuration\DataProcessorConfiguration;
use App\DataProcessor\Application\Service\CsvReader;
use App\DataProcessor\Domain\Repository\ScoreRepository;
use ArrayObject;
use Codeception\PHPUnit\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CreateScoresFromCsvCommandHandlerTest extends TestCase
{
    /** @var ScoreRepository|MockObject */
    private $scoreRepository;

    /** @var CsvReader|MockObject */
    private $csvReader;

    /** @var DataProcessorConfiguration|MockObject */
    private $configuration;

    public function testHandle()
    {
        $this->scoreRepository = $this->createMock(ScoreRepository::class);
        $this->csvReader = $this->createMock(CsvReader::class);
        $this->configuration = $this->createMock(DataProcessorConfiguration::class);

        $this->scoreRepository->expects($this->atLeastOnce())->method("persistCollection");
        $this->csvReader->expects($this->atLeastOnce())->method("createScoresFromCsv")->willReturn(new ArrayObject([]));
        $this->configuration->expects($this->atLeastOnce())->method("getCSVDelimiter");

        $commandHandler = new CreateScoresFromCsvCommandHandler($this->scoreRepository, $this->csvReader, $this->configuration);
        $commandHandler->handle(new CreateScoresFromCsvCommand("filename"));
    }
}
