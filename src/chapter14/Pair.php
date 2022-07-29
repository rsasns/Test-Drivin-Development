<?php

namespace src\chapter14;

class Pair
{
    // 線形検索を行うために privete → public に変更
    public string $from;
    public string $to;

    function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function equals(object $object): bool
    {
        /** @var Pair $pair */
        $pair = $object;
        return $this->from === $pair->from && $this->to === $pair->to;
    }

    public function hashCode(): int
    {
        return 0;
    }
}