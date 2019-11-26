<?php

namespace App\TvShow\Application\Exception;

use Codeception\PHPUnit\TestCase;

class EmptyArgumentExceptionTest extends TestCase
{
    public function testGetExceptionMessage()
    {
        $emptyArgumentException = new EmptyArgumentException();
        $this->assertEquals(EmptyArgumentException::MESSAGE, $emptyArgumentException->getExceptionMessage());
    }
}
