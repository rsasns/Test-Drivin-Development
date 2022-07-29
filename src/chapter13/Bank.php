<?php

namespace src\chapter13;

class Bank
{
    function reduce(Expression $source, string $to): Money
    {
        return $source->reduce($to);
    }
}