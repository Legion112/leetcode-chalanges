<?php

namespace App;

class ValidatePalindromeTwo
{
    function validPalindrome(string $s):bool {
        $l = 0;
        $r = strlen($s) -1;
        while ($l < $r) {
            if ($s[$l] === $s[$r]){
                $l++;
                $r--;
                continue;
            }

            return
                $this->checkPolidromFromPositions($l, $r - 1, $s) ||
                $this->checkPolidromFromPositions($l+1, $r, $s);
        }

        return true;
    }

    private function checkPolidromFromPositions(int $l, int $r, string $s):bool
    {
        while ($l < $r) {
            if ($s[$l] === $s[$r]){
                $l++;
                $r--;
                continue;
            }
            return false;
        }

        return true;
    }
}