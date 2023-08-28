<?php

namespace App;

class RotateImage {

    /**
     * @param Integer[][] $matrix
     * @return NULL
     */
    function rotate(array &$matrix):void {
        $n = count($matrix);

        $numberOfRotation = ceil($n / 2);
        $numberOfRotationJ = floor($n / 2);
        for ($i = 0; $i < $numberOfRotation; $i++) {
            for($j = 0; $j < $numberOfRotationJ; $j++) {
                $tmp  = $matrix[$n - 1- $j][$i];
                $matrix[$n - 1- $j][$i]= $matrix[$n - 1 - $i][$n - 1 - $j];
                $matrix[$n - 1 - $i][$n - 1 - $j] = $matrix[$j][$n - 1 - $i];
                $matrix[$j][$n - 1 - $i] = $matrix[$i][$j];
                $matrix[$i][$j] = $tmp;
            }
        }
    }
}
