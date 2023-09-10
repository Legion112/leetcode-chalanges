<?php

namespace App;


use GMP;

class RobotTotalPathInTwoDMap {

    function uniquePaths(int $m, int $n):int {
        return $this->combination(new GMP($m - 1), new GMP($n - 1));
    }

    private function combination(GMP $h , GMP $v):int {
        return (int)(gmp_fact($h + $v) / gmp_fact($h) / gmp_fact($v));
    }
}