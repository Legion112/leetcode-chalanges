<?php

namespace App;

/** NULL is root node */
class TrieNode
{
    /** @var array<string, TrieNode> $links */
    // public string $char;
    public array $links = [];
    public bool $isEnd = false;

    public function __construct(public ?string $char)
    {

    }
}