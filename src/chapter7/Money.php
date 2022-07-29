<?php

namespace src\chapter7;

class Money
{
    protected int $amount;
    
    public function equals(Money $money): bool
    {
        return $this->amount == $money->amount && get_class($this) == get_class($money);
    }
}