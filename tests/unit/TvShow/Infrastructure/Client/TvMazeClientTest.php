<?php

namespace App\TvShow\Infrastructure\Client;

use Codeception\PHPUnit\TestCase;
use GuzzleHttp\ClientInterface;
use App\TvShow\Application\ValueObject\Url;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;

class TvMazeClientTest extends TestCase
{
    /** @var ClientInterface|MockObject */
    private $clientMock;

    /** @var Url|MockObject */
    private $url;

    protected function setUp(): void
    {
        $this->clientMock = $this->createMock(ClientInterface::class);
        $this->url = $this->createMock(Url::class);
    }

    public function testResult()
    {
        $this->clientMock->method("request")->willReturn(new Response(200, [], 'ok'));
        $client = new TvMazeClient($this->clientMock, $this->url);
        $this->assertEquals("ok", $client->result("showName"));
    }
}
