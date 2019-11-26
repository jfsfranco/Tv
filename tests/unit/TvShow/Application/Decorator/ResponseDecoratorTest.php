<?php

namespace App\TvShow\Application;

use App\TvShow\Application\Decorator\ResponseDecorator;
use Codeception\PHPUnit\TestCase;
use stdClass;

class ResponseDecoratorTest extends TestCase
{
    public function testAddToResponse()
    {
        $responseDecorator = new ResponseDecorator();

        $response = $responseDecorator->addToResponse(new stdClass(), "test", "result");
        $this->assertEquals($response->test, "result");

        $response = $responseDecorator->addToResponse(new stdClass(), "test", null);
        $this->assertEquals($response->test, null);
    }
}
