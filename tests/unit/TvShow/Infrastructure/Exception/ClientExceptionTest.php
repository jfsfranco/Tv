<?php

namespace App\TvShow\Infrastructure\Exception;

use Codeception\PHPUnit\TestCase;

class ClientExceptionTest extends TestCase
{
    /** @var ClientException */
    private $clientException;

    protected function setUp(): void
    {
        $this->clientException = new ClientException();
    }

    public function testGetNotFoundMessage()
    {
        $this->assertEquals(ClientException::NOT_FOUNT_MESSAGE, $this->clientException->getNotFoundMessage());
    }

    public function testGetExternalErrorMessage()
    {
        $this->assertEquals(ClientException::EXTERNAL_ERROR_MESSAGE, $this->clientException->getExternalErrorMessage());
    }
}
