<?php

namespace App\DataProcessor\Application\CommandHandler;

use App\DataProcessor\Application\Command\CreateScoresFromCsvCommand;
use App\DataProcessor\Application\Configuration\DataProcessorConfiguration;
use App\DataProcessor\Application\Service\CsvReader;
use App\DataProcessor\Domain\Repository\ScoreRepository;

class CreateScoresFromCsvCommandHandler
{
    /** @var ScoreRepository */
    private $scoreRepository;

    /** @var CsvReader */
    private $csvReader;

    /** @var DataProcessorConfiguration */
    private $configuration;

    public function __construct(ScoreRepository $scoreRepository, CsvReader $csvReader, DataProcessorConfiguration $configuration)
    {
        $this->scoreRepository = $scoreRepository;
        $this->csvReader = $csvReader;
        $this->configuration = $configuration;
    }

    public function handle(CreateScoresFromCsvCommand $createScoresFromCsvCommand)
    {
        $this->scoreRepository->persistCollection(
            $this->csvReader->createScoresFromCsv(
                $createScoresFromCsvCommand->getFileName(),
                $this->configuration->getCSVDelimiter()
            )
        );
    }
}
