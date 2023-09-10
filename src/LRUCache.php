<?php

namespace App;

class LRUCache {

    private array $mapCacheKeyNode = [];
    private ?TwoWayListNode $head = null;
    private ?TwoWayListNode $tail = null;
    private array $cache = [];
    /**
     * @param Integer $capacity
     */
    function __construct(private readonly int $capacity) {
    }

    function get(int $key):int {
        if (($v = $this->cache[$key] ?? null) === null) {
            return -1;
        }
        if ($this->capacity === 1) {
            return $v;
        }
        $node = $this->mapCacheKeyNode[$key];

        $this->updateTTL($node);
        // it already end nothing to do
        return $v;
    }

    private function updateTTL(TwoWayListNode $node):void {
        $haveMoreThenOneElement = $this->head !== $this->tail;
        if ($haveMoreThenOneElement) {
            if ($node === $this->head) {
                //  next value bacame head
                $headNext = $this->head->getNext();
                $headNext->setPrev(null);
                $this->head->setNext(null);
                $this->head = $headNext;
            } elseif ($node !== $this->tail) {
                // somewhere in middle
                $prev = $node->getPrev();
                $next = $node->getNext();
                $prev->setNext($next);
                $next->setPrev($prev);
            } else {
                // tail nothig to do
                return;
            }
            $this->putToTail($node);
        }
    }

    private function putToTail(TwoWayListNode $node):void
    {
        if ($node === $this->tail) {
            return;
        }
        $node->setNext( null); // forgetting next
        $this->tail->setNext($node); // tail point to node
        $node->setPrev($this->tail); // node prev point to tail
        $this->tail = $node; // node bacame tail
    }

    function put(int $key, int $value):void {
        if ($this->capacity === 1) {
            $this->cache = [$key => $value];
            return;
        }
        if ($this->cache[$key] === null) {
            // new value
            $node = new TwoWayListNode($key);
            $this->mapCacheKeyNode[$key] = $node;
            if (count($this->cache) + 1 > $this->capacity) {
                // no space, need to remove one value
                $this->printLinkedList($this->head);
                // remove head element
                $next = $this->head->getNext();

                $this->head->setNext(null);
                unset($this->cache[$this->head->val]);
                unset($this->mapCacheKeyNode[$this->head->val]);
                $next->setPrev(null);
                $this->head = $next;

                $this->putToTail($node);
            } else {
                // there is space
                if ($this->tail) {
                    $this->putToTail($node);
                } else {
                    $this->head = $this->tail = $node;
                }
            }
        } else {
            $node = $this->mapCacheKeyNode[$key];
            var_dump($node, $this->mapCacheKeyNode, $this->cache);
            $this->updateTTL($node);
        }
        $this->cache[$key] = $value;
    }

    private function printLinkedList(TwoWayListNode $head):void
    {
        $node = $head;
        $values = [];
        do {
            $values[] = $node->val;
        } while(($node = $node->getNext())!== null);
        echo implode('->', $values) . PHP_EOL;
    }
}