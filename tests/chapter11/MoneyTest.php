<?php
namespace tests\chapter11;

use PHPUnit\Framework\TestCase;
use src\chapter11\Money;

Class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function testMultipication()
    {
        /** @var Money $five */
        $five = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $five->times(2));
        $this->assertEquals(Money::dollar(15), $five->times(3));
    }
    /**
     * @test
     */
    public function testEquality()
    {
        $this->assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
        $this->assertFalse((Money::dollar(5))->equals(Money::dollar(6)));
        $this->assertFalse((Money::franc(5))->equals(Money::dollar(5)));
    }
    /**
     * @test
     */
    public function testCurrency()
    {
        $this->assertEquals('USD', Money::dollar(1)->currency());
        $this->assertEquals('CHF', Money::franc(1)->currency());
    }
}
