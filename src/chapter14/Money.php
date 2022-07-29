<?php

namespace src\chapter14;

class Money implements Expression
{
    public int $amount;
    public string $currency;
    // XXX: protected は通らないのでpublicに変更
    // protected int $amount;
    // protected string $currency;
    
    function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }
    
    function times(int $multiplier): Money
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }

    function plus(Money $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function reduce(Bank $bank, string $to): Money
    {
        $rate = $bank->rate($this->currency, $to);
        return new Money($this->amount / $rate, $to);
    }

    function currency(): string
    {
        return $this->currency;
    }

    function equals(Money $money): bool
    {
        return $this->amount == $money->amount && $this->currency() == $money->currency();
    }

    public static function dollar(int $amount): Money
    {
        return new Money($amount, 'USD');
    }

    public static function franc(int $amount): Money
    {
        return new Money($amount, 'CHF');
    }
}