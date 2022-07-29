<?php

namespace src\chapter16;

class Bank
{
    private HashMap $rates;

    function __construct()
    {
        $this->rates = new HashMap;    
    }

    function reduce(Expression $source, string $to): Money
    {
        return $source->reduce($this, $to);
    }

    function addRate(string $from, string $to, int $rate): void
    {
        $this->rates->put(new Pair($from, $to), $rate);
    }

    function rate(string $from, string $to): int
    {
        return $this->rates->get(new Pair($from, $to));
    }
}