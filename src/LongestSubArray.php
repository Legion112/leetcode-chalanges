<?php

namespace App;

class LongestSubArray
    /**
     * @param Integer[] $nums
     */
    public function longestSubarray(array $nums):int {
        $prevNode = new Node(0);
        $lists = [ $prevNode ];
        $currentNode = null;
        $zereBefore = 0;
        $haveEventMeetZero = false;
        // O(n)
        foreach ($nums as $n) {
            if ($n === 0) {
                $haveEventMeetZero = true;
                if ($currentNode !== null) {
                    $prevNode = $currentNode;
                    $currentNode = null;
                }
                if ($zereBefore >= 1) {
                    // interapted by 00
                    $zereBefore = 0;
                    $prevNode = new Node(0);
                    $lists[] = $prevNode;
                    continue;
                }

                if ($prevNode->count > 0) {
                    $zereBefore++;
                }
                continue;
            }
            $zereBefore = 0;

            if ($currentNode === null) {
                $currentNode = new Node(1);
                $prevNode->next = $currentNode;
                continue;
            }
            $currentNode->count++;
        }
        if (!$haveEventMeetZero) {
            return count($nums) - 1;
        }
        $max = 0;
        foreach ($lists as $node) {
            do {
                $max = max($node->count + $node->next?->count ?? 0, $max);
            } while( ($node = $node->next ) !== false);
        }

        return $max;
    }

}
