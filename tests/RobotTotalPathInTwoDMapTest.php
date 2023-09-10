<?php

namespace Tests;

use App\RobotTotalPathInTwoDMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RobotTotalPathInTwoDMapTest extends TestCase
{
    public static function cases():\Generator
    {
        yield [
          19, 13, 86493225,
        ];
    }

    #[Test]
    #[DataProvider('cases')]
    public function uniquePaths(int $m, int $n, int $expected):void
    {
        self::assertSame(
            $expected,
            (new RobotTotalPathInTwoDMap())->uniquePaths($m, $n),
        );
    }
}
