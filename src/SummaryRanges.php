<?php

namespace App;

class SummaryRanges {

    /**
     * @param Integer[] $nums
     * @return String[]
     */
    function summaryRanges(array $nums):array {

        $output = [];
        $lng = count($nums);
        if ($lng === 0) {
            return [];
        }
        if ($lng === 1) {
            return [(string)$nums[0]];
        }
        $prev = $nums[0];
        $start = $nums[0];
        $finish = null;
        for ($i = 1; $i < $lng; $i++) {
            $next = $nums[$i];
            if (($next - 1) !== $prev) {
                $finish = $prev;
            }

            if ($finish !== null) {
                if ($start === $finish) {
                    $output[] = (string)$start;
                } else {
                    $output[] = $start . '->' . $finish;
                }
                $finish = null;
                $start = $next;
            }

            $prev = $next;
        }

        if ($finish === null) {
            $finish = $prev;
            if ($start === $finish) {
                $output[] = (string)$start;
            } else {
                $output[] = $start . '->' . $finish;
            }
        }

        return $output;
    }
}