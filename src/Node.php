<?php

namespace App;

class Node {
    public ?Node $next = null;
    public function __construct(public int $count) {}
}