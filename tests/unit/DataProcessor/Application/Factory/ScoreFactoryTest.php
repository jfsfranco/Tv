<?php

namespace App\DataProcessor\Application\Factory;

use App\DataProcessor\Application\Exception\InvalidDataException;
use App\DataProcessor\Domain\Score;
use Codeception\PHPUnit\TestCase;

class ScoreFactoryTest extends TestCase
{
    /** @var ScoreFactory */
    private $scoreFactory;

    protected function setUp(): void
    {
        $this->scoreFactory = new ScoreFactory();
    }

    public function testCreateSuccessful()
    {
        $this->assertInstanceOf(
            Score::class,
            $this->scoreFactory->create("name", 1, "2019-05-05")
        );
    }

    public function testCreateTopLimit()
    {
        $this->expectException(InvalidDataException::class);
        $this->scoreFactory->create("name", 150, "2019-05-05");
    }

    public function testCreateBottomLimit()
    {
        $this->expectException(InvalidDataException::class);
        $this->scoreFactory->create("name", -5, "2019-05-05");
    }

    /**
     * @dataProvider nullValueProvider()
     */
    public function testCreateNullValues($nameOfShow, $brandFitScore, $generateDate)
    {
        $this->expectException(InvalidDataException::class);
        $this->scoreFactory->create($nameOfShow, $brandFitScore, $generateDate);
    }

    public function nullValueProvider()
    {
        return [
            "nameOfShow empty" => [null, 100, "2019-05-01"],
            "brandFitScore empty" => ["Lord of the rings", null,  "2019-05-01"],
            "generateDate empty" => ["Lord of the rings", 100, null],
        ];
    }
}
