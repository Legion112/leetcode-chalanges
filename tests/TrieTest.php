<?php

namespace Tests;

use App\Trie;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TrieTest extends TestCase
{
    private Trie $trie;

    public function __construct(string $name)
    {
        $this->trie = new Trie();
        parent::__construct($name);
    }

    #[Test]
    public function insertAndFindItShouldReturnTrue():void
    {
        $this->trie->insert('word');
        self::assertTrue(
            $this->trie->search('word')
        );
    }

    #[Test]
    public function insertAppleAndTryToFindPrifixAppShouldReturnTrue():void
    {
        $this->trie->insert('apple');
        self::assertTrue(
            $this->trie->startsWith('app')
        );
    }

}
