<?php

namespace App\TvShow\Infrastructure\Factory;

use App\TvShow\Application\Exception\EmptyArgumentException;
use App\TvShow\Domain\Exception\InvalidTvShowNameException;
use App\TvShow\Infrastructure\Exception\ClientException;
use Exception;
use Illuminate\Http\Response;
use Throwable;
use Codeception\PHPUnit\TestCase;

class ErrorResponseFactoryTest extends TestCase
{
    /** @var ErrorResponseFactory */
    private $errorResponseFactory;

    protected function setUp(): void
    {
        $this->errorResponseFactory = new ErrorResponseFactory();
    }

    /**
     * @dataProvider ErrorExceptionProvider
     */
    public function testCreateResponseForException(
        Throwable $exception,
        string $expectedString
    ) {
        $response = $this->errorResponseFactory->createResponseForException($exception);
        $this->assertEquals($expectedString, $response->getData());
    }


    public function ErrorExceptionProvider(): array
    {
        return [
            "Case InvalidTvShowNameException" => [new InvalidTvShowNameException(), InvalidTvShowNameException::MESSAGE],
            "Case EmptyArgumentException" => [new EmptyArgumentException(), EmptyArgumentException::MESSAGE],
            "Case ClientException" => [new ClientException(), (new ClientException())->getExternalErrorMessage()],
            "Case ClientException Not Found" => [new ClientException("", Response::HTTP_NOT_FOUND), (new ClientException())->getNotFoundMessage()],
            "Case Exception" => [new Exception("Internal Error"), "Internal Error"],
        ];
    }
}
