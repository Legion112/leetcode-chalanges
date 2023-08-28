<?php

namespace Tests;

use App\RotateImage;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RotateImageTest extends TestCase
{
    private readonly RotateImage $solution;

    public function setUp(): void
    {
        $this->solution = new RotateImage();
        parent::setUp();
    }

    public function dataMatrix():\Generator
    {
        yield [
            [[1,2,3],[4,5,6],[7,8,9]],
            [[7,4,1],[8,5,2],[9,6,3]],
        ];

        yield [
            [[1, 2, 3, 4],[5,6,7,8],[9,10,11,12],[13,14,14,15]],
            [[13,9,5,1],[14,10,6,2],[15,11,7,3],[16,12,8,4]],
        ];

        yield [
            [[1, 2, 3, 4, 5],[6,7,8, 9, 10],[11,12, 13, 14, 15],[16, 17, 18, 19, 20], [21, 22, 23, 24, 25]],
            [[21, 16,11,6,1],[22, 17,12,7,2],[23, 18,13,8,3], [24,19, 14,9,4], [25,20,15,10,5]],
        ];


        yield [
            [[5,1,9,11],[2,4,8,10],[13,3,6,7],[15,14,12,16]],
            [[15,13,2,5],[14,3,4,1],[12,6,8,9],[16,7,10,11]],
        ];
    }


    #[DataProvider('dataMatrix')]
    public function checkRotation(array $matrix, $expected):void
    {
        $origin = $this->print2DMatrix($matrix);
        $this->solution->rotate($matrix);

        self::assertEquals($expected, $matrix, $origin . $this->print2DMatrix($expected) . $this->print2DMatrix($matrix));
    }
                
    public static function inputWithExpectedPositions():\Generator
    {
        yield [
            0,
            3,
            [
                [2, 0],
                [2, 2],
               [0, 2],
            ]
        ];
        yield [
            1,
            0,
            3,
        [
                [2, 1],
                [1, 2],
                [0, 1],
            ]
        ];
    }

    #[DataProvider('inputWithExpectedPositions')]
    #[Test]
    public function shouldReturnRightRotationPositions(int $x, int $y, int $n, array $positions):void
    {
        $result = iterator_to_array($this->solution->getPositions($x, $y, $n));

        self::assertEquals($positions, $result);
    }

    public function print2DMatrix(array &$matrix):string
    {
        $out = '';
        $size = count($matrix);
        for ($y=0; $y < $size; $y++) {
            $out .= implode('|',
                    array_map(fn($v) => str_pad($v, 2, ' ', STR_PAD_LEFT),$matrix[$y])
            ) . PHP_EOL;
        }
        return $out . PHP_EOL;
    }
}
