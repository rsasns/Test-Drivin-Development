<?php

namespace src\chapter13;

interface Expression
{
    function reduce(string $to): Money;
}