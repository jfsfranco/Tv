<?php

namespace App\TvShow\Application\QueryHandler;

use App\TvShow\Application\Adapter\CacheProxy;
use App\TvShow\Application\Client\Client;
use App\TvShow\Application\Configuration;
use App\TvShow\Application\Decorator\ResponseDecorator;
use App\TvShow\Application\Query\TvShowQuery;
use App\TvShow\Application\Searcher\TvShowSearcherInterface;
use App\TvShow\Domain\Score;
use App\TvShow\Domain\ScoreRepository;
use App\TvShow\Domain\TvShow;
use stdClass;

final class TvShowQueryHandler implements QueryHandler
{
    /** @var CacheProxy */
    private $cache;

    /** @var Client */
    private $client;

    /** @var Configuration */
    private $configuration;

    /** @var TvShowSearcherInterface */
    private $tvShowSearcher;

    /** @var ScoreRepository */
    private $scoreRepository;

    /** @var ResponseDecorator */
    private $responseDecorator;

    public function __construct(
        CacheProxy $cache,
        Client $client,
        Configuration $configuration,
        TvShowSearcherInterface $tvShowSearcher,
        ScoreRepository $scoreRepository,
        ResponseDecorator $responseDecorator
    ) {
        $this->cache = $cache;
        $this->client = $client;
        $this->configuration = $configuration;
        $this->tvShowSearcher = $tvShowSearcher;
        $this->scoreRepository = $scoreRepository;
        $this->responseDecorator = $responseDecorator;
    }

    public function handle(TvShowQuery $tvShowQuery): ?stdClass
    {
        $tvShow = new TvShow($tvShowQuery->getName());
        $tvShowResponseData = unserialize($this->cache->getFromCache($tvShow->getName()));

        if (!$tvShowResponseData) {
            $response = $this->tvShowSearcher->search(json_decode($this->client->result($tvShow->getName())), $tvShow);
            if (!$response) {
                return null;
            }
            $score = $this->scoreRepository->findOneByName($tvShow->getName());
            $tvShowResponseData = $this->responseDecorator->addToResponse(
                $response,
                Score::BRAND_FIT_SCORE,
                $score ? $score->getScore() : null
            );
            $this->cache->pushToCache(
                serialize($tvShowResponseData), $tvShow->getName(), $this->configuration->getCacheDuration()
            );
        }
        return $tvShowResponseData;
    }
}
