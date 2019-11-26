<?php

namespace App\DataProcessor\Infrastructure\Repository;

use ArrayObject;
use Codeception\PHPUnit\TestCase;
use App\DataProcessor\Domain\Score;

class ScoreEloquentRepositoryTest extends TestCase
{
    public function testPersistCollection()
    {
        $scoreMock = $this->createMock(Score::class);
        $scoreMock->expects(self::exactly(1))->method("save");

        $scoreEloquentRepository = new ScoreEloquentRepository();
        $scoreEloquentRepository->persistCollection(new ArrayObject([$scoreMock]));
    }
}
