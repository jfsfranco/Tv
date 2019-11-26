<?php

namespace App\TvShow\Infrastructure\Client;

use App\TvShow\Application\Client\Client;
use App\TvShow\Application\ValueObject\Url;
use App\TvShow\Infrastructure\Exception\ClientException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class TvMazeClient implements Client
{
    const GET = "GET";

    /** @var ClientInterface */
    private $guzzleClient;

    /** @var Url */
    private $url;

    public function __construct(ClientInterface $guzzleClient, Url $url)
    {
        $this->guzzleClient = $guzzleClient;
        $this->url = $url;
    }

    public function result(string $tvShowName): string
    {
        try {
            return $this->guzzleClient->request(
                self::GET,
                $this->url->getUrlWithQuery($tvShowName))->getBody()->getContents();
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage(), $exception->getCode());
        }
    }
}
