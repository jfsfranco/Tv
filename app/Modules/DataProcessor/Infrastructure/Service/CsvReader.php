<?php

namespace App\DataProcessor\Infrastructure\Service;

use App\DataProcessor\Application\Factory\ScoreFactoryInterface;
use App\DataProcessor\Infrastructure\Exception\InvalidFileFormatException;
use App\DataProcessor\Application\Service\CsvReader as CsvReaderInterface;
use App\DataProcessor\Domain\Score;
use ArrayObject;

class CsvReader implements CsvReaderInterface
{
    /** @var ScoreFactoryInterface */
    private $scoreFactory;

    public function __construct(ScoreFactoryInterface $scoreFactory)
    {
        $this->scoreFactory = $scoreFactory;
    }

    function createScoresFromCsv(string $filename, string $delimiter): ArrayObject
    {
        $header = null;
        $scores = new ArrayObject([]);
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, count(file($filename)), ";")) !== false) {
                $row = explode($delimiter, $row[0]);
                if (!$header) {
                    $header = $row;
                    $this->guardAgainstInvalidDelimiter($row);
                } else {
                    $score = $this->scoreFactory->create($row[0], $row[1], $row[2]);
                    $scores->append($score);
                }
            }
            fclose($handle);
        }
        return $scores;
    }

    private function guardAgainstInvalidDelimiter(array $row)
    {
        if (($row[0] != "name_of_show") || ($row[1] != "brand_fit_score") || ($row[2] != "generated_date")) {
            throw new InvalidFileFormatException();
        }
    }
}
