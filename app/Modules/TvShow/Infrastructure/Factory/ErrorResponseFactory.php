<?php

namespace App\TvShow\Infrastructure\Factory;

use App\TvShow\Application\Exception\EmptyArgumentException;
use App\TvShow\Domain\Exception\InvalidTvShowNameException;
use App\TvShow\Application\Factory\ErrorFactory;
use App\TvShow\Infrastructure\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class ErrorResponseFactory implements ErrorFactory
{
    public function createResponseForException(Throwable $exception): JsonResponse
    {
        switch (get_class($exception)) {
            case InvalidTvShowNameException::class:
            case EmptyArgumentException::class:
                $response = $this->createResponse($exception->getExceptionMessage(), Response::HTTP_BAD_REQUEST);
                break;
            case ClientException::class:
                $response = $this->createResponse($exception->getExternalErrorMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                if ($exception->getCode() == Response::HTTP_NOT_FOUND) {
                    $response = $this->createResponse($exception->getNotFoundMessage(), Response::HTTP_NOT_FOUND);
                }
                break;
            default:
                $response = $this->createResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                break;
        }
        return $response;
    }

    private function createResponse(string $message, int $code): JsonResponse
    {
        return new JsonResponse($message, $code);
    }
}
