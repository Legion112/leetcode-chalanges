<?php

namespace App;

class ATM {
    private array $map = [
        0 => 20,
        1 => 50,
        2 => 100,
        3 => 200,
        4 => 500,
    ];

    private array $banknotes = [4 => 0, 3 => 0, 2 => 0, 1 => 0, 0 => 0];

    function __construct() {

    }

    function deposit(array $banknotes):void {
        foreach ($banknotes as $banknote => $add) {
            $this->banknotes[$banknote] += $add;
        }
    }

    function withdraw(int $amount):array {
        $banknotes = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0];
        foreach($this->banknotes as $banknoteIndex => $count) {
            if ($amount === 0) {
                break;
            }
            if ($count === 0) {
                continue;
            }

            $banknote = $this->map[$banknoteIndex];
            $take = min($count, (int) ($amount / $banknote));
            $diff = $amount - $take * $banknote;

            $banknotes[$banknoteIndex] += $take;
            $amount = $diff;
        }

        if ($amount !== 0) {
            return [-1];
        }
        foreach ($banknotes as $banknote => $sub) {
            $this->banknotes[$banknote] -= $sub;
        }
        return $banknotes;
    }
}