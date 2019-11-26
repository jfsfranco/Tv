<?php

namespace App\TvShow\Domain;

use PHPUnit\Framework\TestCase;

class ScoreTest extends TestCase
{
    public function testGetScore()
    {
        $score = new Score();
        $score->setAttribute(Score::BRAND_FIT_SCORE, 64);
        $this->assertEquals(64, $score->getScore());
    }
}
