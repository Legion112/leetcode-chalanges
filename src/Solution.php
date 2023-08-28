<?php
namespace App;

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target) {
        $midIndex = $this->getMidIndex($min = 0, $max = count($nums) - 1);
        $midValue = $nums[$midIndex];
        while ($midValue !== $target) {
            if ($midValue < $target) {
                $min = $midIndex;
            } elseif ($midValue > $target) {
                $max = $midIndex;
            }
            $midIndex = $this->getMidIndex($min, $max);
            if (($diff = ($max - $min)) === 1) {
                if ($nums[$min] === $target) return $min;
                if ($nums[$max] === $target) return $max;
                return -1;
            } elseif ($diff === 0) {
                return $nums[$min] === $target ? $min : -1;
            }
            $midValue = $nums[$midIndex];
        }
        return $midIndex;
    }


    function getMidIndex(int $start, int $end):int {
        return $start + floor(($end - $start) / 2);
    }
}