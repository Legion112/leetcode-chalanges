<?php

namespace Tests;

use App\Solution;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    private Solution $solution;

    protected function setUp(): void
    {
        $this->solution = new Solution();
        parent::setUp();
    }

    public static function casesWithExistingPosition(): Generator
    {
        yield [
            [-1,0,3,5,9,12],
            9,
            4
        ];
    }

    #[DataProvider('casesWithExistingPosition')]
    #[Test]
    public function runSearchWithExistingElement(array $nums, int $target, int $expectedPosition):void
    {
        $result = $this->solution->search($nums, $target);
        self::assertNotSame(-1, $result, 'Search did not find existing element');
        self::assertSame(
            $expectedPosition,
            $result,
            'Position is wrong'
        );
    }
}