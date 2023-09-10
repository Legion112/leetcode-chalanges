<?php

namespace Tests;

use App\ATM;
use PHPUnit\Framework\TestCase;

class ATMTest extends TestCase
{
    /**
     * ["ATM", "deposit", "withdraw", "deposit", "withdraw", "withdraw"]
     * [[], [[0,0,1,2,1]], [600], [[0,1,0,1,1]], [600], [550]]
     */
    public function testCase1():void
    {
        $atm = new ATM();
        $atm->deposit([0,0,1,2,1]);
        self::assertSame(
            [0, 0, 1, 0, 1],
            $atm->withdraw(600),
        );
    }

    /**
     * ["ATM","deposit","withdraw"]
     * [[],[[0,10,0,3,0]],[500]]
     */
    public function testCase13():void
    {
        $atm = new ATM();
        $atm->deposit([0,10,0,3,0]);
        self::assertSame(
            [0, 2, 0, 2, 0],
            $atm->withdraw(500),
        );
    }

}
