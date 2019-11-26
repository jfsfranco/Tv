<?php

namespace App\DataProcessor\Infrastructure\Factory;

use App\DataProcessor\Application\Exception\InvalidDataException;
use App\DataProcessor\Application\Factory\CsvProcessorErrorFactory as CsvProcessorErrorFactoryInterface;
use App\DataProcessor\Infrastructure\Exception\ErrorReadingFileException;
use App\DataProcessor\Infrastructure\Exception\FileNotExistException;
use App\DataProcessor\Infrastructure\Exception\InvalidFileFormatException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class CsvProcessorErrorFactory implements CsvProcessorErrorFactoryInterface
{
    public function createResponseForException(Throwable $exception): JsonResponse
    {
        switch (get_class($exception)) {
            case ErrorReadingFileException::class:
                $response = $this->createResponse(ErrorReadingFileException::MESSAGE, Response::HTTP_BAD_REQUEST);
                break;
            case InvalidFileFormatException::class:
                $response = $this->createResponse(InvalidFileFormatException::MESSAGE, Response::HTTP_UNPROCESSABLE_ENTITY);
                break;
            case FileNotExistException::class:
                $response = $this->createResponse(FileNotExistException::MESSAGE, Response::HTTP_UNPROCESSABLE_ENTITY);
                break;
            case InvalidDataException::class:
                $response = $this->createResponse(InvalidDataException::MESSAGE, Response::HTTP_UNPROCESSABLE_ENTITY);
                break;
            default:
                $response = $this->createResponse("Internal Error", Response::HTTP_INTERNAL_SERVER_ERROR);
                break;
        }
        return $response;
    }

    private function createResponse(string $message, int $code): JsonResponse
    {
        return new JsonResponse($message, $code);
    }
}
