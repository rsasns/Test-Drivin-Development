<?php

namespace src\chapter14;

interface Expression
{
    function reduce(Bank $bank, string $to): Money;
}