<?php

namespace App;

class ListPalindrome {

    function isPalindrome(ListNode $head):bool {
        if ($head->next === null) return true;
        $size = $this->countNodes($head);
        $isEven = ($size % 2) === 0;
        $middle = floor($size / 2);

        // reverse list till reaching middle (so we would have two equally sized list form middle to oposite side)
        $current = $head;
        $prev = null;
        $next = $current->next;
        for ($nodeCount = 0; $nodeCount < $middle; $nodeCount++) {
            // reversing logic
            $current->next = $prev;

            $prev = $current;
            $current = $next;
            $next = $next->next;
        }

        // Determining where is the head of two list
        $leftHead = $prev;
        $rightHead = $isEven ? $current : $next;

        // from middle use "two pointer" approuch for comparing node values till reaching null
        $left = $leftHead;
        $right = $rightHead;
        do {
            if ($left->val !== $right->val) {
                return false;
            }
        } while (($right = $right->next) !== null | ($left = $left->next) !== null);

        return true;


    }

    function countNodes(ListNode $head):int {
        $counter = 1;
        $next = $head;
        while (($next = $next->next) !== null) $counter++;

        return $counter;
    }
}