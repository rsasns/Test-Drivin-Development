<?php

namespace src\chapter15;

/**
 * HashMapの代わりとなるクラス
 */
class HashMap
{
    public array $values = [];

    function put(Pair $pair, int $rate): void
    {
        $this->values[$pair->from.$pair->to] = $rate;
    }

    function get(Pair $pair): int
    {
        if ($pair->from === $pair->to) return 1;
        return $this->values[$pair->from.$pair->to];
    }
}