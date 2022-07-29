<?php

namespace src\chapter16;

interface Expression
{
    function times(int $multipler): Expression;
    function plus(Expression $addend): Expression;
    function reduce(Bank $bank, string $to): Money;
}