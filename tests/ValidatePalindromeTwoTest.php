<?php

namespace Tests;

use App\ValidatePalindromeTwo;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ValidatePalindromeTwoTest extends TestCase
{
    private ValidatePalindromeTwo $solutoin;

    protected function setUp(): void
    {
        $this->solutoin = new ValidatePalindromeTwo();
        parent::setUp();
    }

    public static function trueCases():\Generator
    {
        yield [
            'deeee',
        ];
        return;
        yield [
            'cupuufxoohdfpgjdmysgvhmvffcnqxjjxqncffvmhvgsymdjgpfdhooxfuupucu',
        ];
        yield [
            'aguokepatgbnvfqmgmlcupuufxoohdfpgjdmysgvhmvffcnqxjjxqncffvmhvgsymdjgpfdhooxfuupuculmgmqfvnbgtapekouga'
        ];
    }
    #[DataProvider('trueCases')]
    #[Test]
    public function validPalindromeTrue(string $input):void
    {
        self::assertTrue(
            $this->solutoin->validPalindrome($input),
            "$input should be polindrome"
        );
    }
}
