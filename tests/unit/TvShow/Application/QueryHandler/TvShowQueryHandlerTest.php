<?php

namespace App\TvShow\Application\QueryHandler;

use App\TvShow\Application\Client\Client;
use App\TvShow\Application\Configuration;
use App\TvShow\Application\Decorator\ResponseDecorator;
use App\TvShow\Application\Decorator\ResponseDecoratorInterface;
use App\TvShow\Application\Query\TvShowQuery;
use App\TvShow\Application\Searcher\TvShowSearcherInterface;
use App\TvShow\Domain\Score;
use App\TvShow\Domain\ScoreRepository;
use Codeception\PHPUnit\TestCase;
use DateInterval;
use App\TvShow\Application\Adapter\CacheProxy;
use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

class TvShowQueryHandlerTest extends TestCase
{
    const GET_FROM_CACHE = "getFromCache";
    const EXAMPLE_TVSHOW = "Deadpool";
    /** @var CacheProxy|MockObject */
    private $cacheProxyMock;
    /** @var Client|MockObject */
    private $clientMock;
    /** @var Configuration|MockObject */
    private $configurationMock;
    /** @var TvShowSearcherInterface|MockObject */
    private $tvShowSearcherMock;
    /** @var ScoreRepository|MockObject */
    private $scoreRepositoryMock;
    /** @var ResponseDecoratorInterface|MockObject */
    private $responseDecoratorMock;

    protected function setUp(): void
    {
        $this->cacheProxyMock = $this->createMock(CacheProxy::class);
        $this->clientMock = $this->createMock(Client::class);
        $this->configurationMock = $this->createMock(Configuration::class);
        $this->tvShowSearcherMock = $this->createMock(TvShowSearcherInterface::class);
        $this->scoreRepositoryMock = $this->createMock(ScoreRepository::class);
        $this->responseDecoratorMock = $this->createMock(ResponseDecorator::class);
    }

    public function testResponseIsInTheCache()
    {
        $response = new stdClass();
        $this->cacheProxyMock->method(self::GET_FROM_CACHE)->willReturn(serialize($response));

        $tvShowQueryHandler = new TvShowQueryHandler(
            $this->cacheProxyMock,
            $this->clientMock,
            $this->configurationMock,
            $this->tvShowSearcherMock,
            $this->scoreRepositoryMock,
            $this->responseDecoratorMock
        );

        $this->assertEquals($response, $tvShowQueryHandler->handle(new TvShowQuery(self::EXAMPLE_TVSHOW)));
    }

    public function testResponseFromTheClientIsNull()
    {
        $this->cacheProxyMock->method(self::GET_FROM_CACHE)->willReturn(null);
        $this->tvShowSearcherMock->method("search")->willReturn(null);
        $this->clientMock->method("result")->willReturn("[{}]");

        $tvShowQueryHandler = new TvShowQueryHandler(
            $this->cacheProxyMock,
            $this->clientMock,
            $this->configurationMock,
            $this->tvShowSearcherMock,
            $this->scoreRepositoryMock,
            $this->responseDecoratorMock
        );

        $this->assertEquals(null, $tvShowQueryHandler->handle(new TvShowQuery(self::EXAMPLE_TVSHOW)));
    }

    public function testResponseFromTheClientIsCorrect()
    {
        $this->cacheProxyMock->method(self::GET_FROM_CACHE)->willReturn(null);
        $this->tvShowSearcherMock->method("search")->willReturn(new stdClass());
        $this->clientMock->method("result")->willReturn("[{}]");
        $scoreMock = $this->createMock(Score::class);
        $scoreMock->method("getScore")->willReturn("5");
        $this->scoreRepositoryMock->method("findOneByName")->willReturn($scoreMock);
        $this->cacheProxyMock->method("pushToCache")->willReturn(true);
        $this->configurationMock->method("getCacheDuration")->willReturn(new DateInterval("P2Y4DT6H8M"));
        $this->responseDecoratorMock->method("addToResponse")->willReturn(new stdClass());

        $tvShowQueryHandler = new TvShowQueryHandler(
            $this->cacheProxyMock,
            $this->clientMock,
            $this->configurationMock,
            $this->tvShowSearcherMock,
            $this->scoreRepositoryMock,
            $this->responseDecoratorMock
        );

        $this->assertInstanceOf(stdClass::class, $tvShowQueryHandler->handle(new TvShowQuery(self::EXAMPLE_TVSHOW)));
    }
}
