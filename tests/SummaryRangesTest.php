<?php

namespace Tests;

use App\SummaryRanges;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SummaryRangesTest extends TestCase
{
    public function cases():\Generator
    {
        yield [
            [0,1,2,4,5,7],
            ["0->2","4->5","7"],
        ];

        yield [
            [0,2,3,4,6,8,9],
            ["0","2->4","6","8->9"],
        ];
    }

    #[DataProvider('cases')]
    #[Test]
    public function summaryRanges(array $ranges, array $expected):void
    {
        $result = (new SummaryRanges())->summaryRanges($ranges);

        self::assertSame(
            $expected,
            $result,
        );
    }
}
