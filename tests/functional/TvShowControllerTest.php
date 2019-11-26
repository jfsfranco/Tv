<?php

namespace App\Controller;

use App\TvShow\Application\Exception\EmptyArgumentException;
use Codeception\Test\Unit;
use GuzzleHttp\Client;
use Illuminate\Http\Response as ResponseHttp;
use Symfony\Component\HttpFoundation\Response;

class TvShowControllerTest extends Unit
{
    /** @var Client */
    private $guzzleClient;

    protected function setUp(): void
    {
        $this->guzzleClient = new Client([
            'base_uri' => 'http://localhost'
        ]);
    }

    public function testEmptyTvShow()
    {
        try {
            $response = $this->guzzleClient->request('GET', '/tv/tv/public/?q=');
        } catch (\Throwable $exception)  {
            $response = $exception->getMessage();
        }
//        echo $exception->getMessage();
//        die();
        $this->assertEquals(true, strpos($response, (string)ResponseHttp::HTTP_BAD_REQUEST));
//        $this->assertEquals(EmptyArgumentException::MESSAGE, $body);
//        $this->assertEquals(EmptyArgumentException::MESSAGE, $body);
//        $this->assertEquals(ResponseHttp::HTTP_BAD_REQUEST, $response->getStatusCode());
//        $this->assertEquals(['application/json'], $response->getHeaders()['Content-Type']);
    }
}
