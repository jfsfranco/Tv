<?php

namespace App\DataProcessor\Infrastructure\Factory;

use App\DataProcessor\Application\Exception\InvalidDataException;
use App\DataProcessor\Infrastructure\Exception\ErrorReadingFileException;
use App\DataProcessor\Infrastructure\Exception\FileNotExistException;
use App\DataProcessor\Infrastructure\Exception\InvalidFileFormatException;
use Codeception\PHPUnit\TestCase;
use Exception;
use Throwable;

class CsvProcessorErrorFactoryTest extends TestCase
{
    /** @var CsvProcessorErrorFactory */
    private $csvProcessorErrorFactory;

    protected function setUp(): void
    {
        $this->csvProcessorErrorFactory = new CsvProcessorErrorFactory();
    }

    /**
     * @dataProvider ErrorExceptionProvider
     */
    public function testCreateResponseForException(
        Throwable $exception,
        string $expectedString
    ) {
        $response = $this->csvProcessorErrorFactory->createResponseForException($exception);
        $this->assertEquals($expectedString, $response->getData());
    }


    public function ErrorExceptionProvider(): array
    {
        return [
            "Case ErrorReadingFileException" => [new ErrorReadingFileException(), ErrorReadingFileException::MESSAGE],
            "Case InvalidFileFormatException" => [new InvalidFileFormatException(), InvalidFileFormatException::MESSAGE],
            "Case FileNotExistException" => [new FileNotExistException(), FileNotExistException::MESSAGE],
            "Case InvalidDataException" => [new InvalidDataException(), InvalidDataException::MESSAGE],
            "Case Exception" => [new Exception("Internal Error"), "Internal Error"],
        ];
    }
}
