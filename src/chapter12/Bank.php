<?php

namespace src\chapter12;

class Bank
{
    public function reduce(Expression $source): Money
    {
        return Money::dollar(10);
    }
}