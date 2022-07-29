<?php

namespace src\chapter5;

class Franc {
    private int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier): Franc
    {
        return new Franc($this->amount * $multiplier);
    }

    public function equals(Franc $Franc): bool
    {
        return $this->amount == $Franc->amount;
    }
}