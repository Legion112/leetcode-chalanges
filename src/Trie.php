<?php

namespace App;

class Trie {

    public TrieNode $node;
    function __construct() {
        $this->node = new TrieNode(null);
    }

    function insert(string $word):void {
        if (strlen($word) === 0) {
            return;
        }

        $prevNode = $this->node;

        foreach (str_split($word) as $char ) {
            if (isset($prevNode->links[$char])) {
                $node = $prevNode->links[$char];
            } else {
                $prevNode->links[$char] = $node = new TrieNode($char);
            }
            $prevNode = $node;
        }
        $prevNode->isEnd = true;
    }

    function search(string $word):bool {
        $prevNode = $this->node;
        foreach (str_split($word) as $char ) {
            if (!isset($prevNode->links[$char])) {
                return false;
            }
            $prevNode = $prevNode->links[$char];
        }
        return $prevNode->isEnd;
    }

    function startsWith(string $prefix):bool {
        $prevNode = $this->node;

        foreach (str_split($prefix) as $char ) {
            if (isset($prevNode->links[$char])) {
                return false;
            } else {
                $prevNode->links[$char] = $node = new TrieNode($char);
            }
            $prevNode = $node;
        }
        return true;
    }
}

