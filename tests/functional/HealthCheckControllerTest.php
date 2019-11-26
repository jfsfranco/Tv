<?php

namespace App\Controller;

use Codeception\Test\Unit;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends Unit
{
    /** @var Client */
    private $guzzleClient;

    protected function setUp(): void
    {
        $this->guzzleClient = new Client([
            'base_uri' => 'http://localhost'
        ]);
    }

    public function testHappyPath()
    {
        $response = $this->guzzleClient->request('GET', '/tv/tv/public/healthCheck');
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(['application/json'], $response->getHeaders()['Content-Type']);
    }
}
