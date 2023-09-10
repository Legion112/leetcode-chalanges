<?php

namespace App;

class TwoWayListNode
{
    private ?self $next = null;
    private ?self $prev = null;
    public function __construct(public readonly string $val)
    {

    }

    public function setNext(?self $node):void
    {
        if ($this === $node) {
            throw new \Exception('Cannot reference to itself');
        }
        $this->next = $node;
    }

    public function setPrev(?self $node):void
    {
        if ($this === $node) {
            throw new \Exception('Cannot reference to itself');
        }
        $this->prev = $node;
    }

    public function getNext():?self
    {
        return $this->next;
    }

    public function getPrev():?self
    {
        return $this->prev;
    }
}