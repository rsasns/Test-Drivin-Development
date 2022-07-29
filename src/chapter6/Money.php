<?php

namespace src\chapter6;

class Money
{
    protected int $amount;
    
    public function equals(Money $money): bool
    {
        return $this->amount == $money->amount;
    }
}