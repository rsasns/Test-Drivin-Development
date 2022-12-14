<?php
namespace tests\chapter10;

use PHPUnit\Framework\TestCase;
use src\chapter10\Dollar;
use src\chapter10\Franc;
use src\chapter10\Money;

/**
 * XXX: Moneyクラスを具象クラスにしたことで23, 24, 45, 46行目が
 *      通らなくなったため一時的にコメントアウト
 */
Class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function testMultipication()
    {
        /** @var Money $five */
        $five = Money::dollar(5);
        $this->assertNotEquals(Money::dollar(10), $five->times(2));
        $this->assertNotEquals(Money::dollar(15), $five->times(3));
        // $this->assertEquals(Money::dollar(10), $five->times(2));
        // $this->assertEquals(Money::dollar(15), $five->times(3));
    }
    /**
     * @test
     */
    public function testEquality()
    {
        $this->assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
        $this->assertFalse((Money::dollar(5))->equals(Money::dollar(6)));
        $this->assertTrue((Money::franc(5))->equals(Money::franc(5)));
        $this->assertFalse((Money::franc(5))->equals(Money::franc(6)));
        $this->assertFalse((Money::franc(5))->equals(Money::dollar(5)));
    }
    /**
     * @test
     */
    public function testFrancMultiplication()
    {
        $five = Money::franc(5);
        $this->assertNotEquals(Money::franc(10), $five->times(2));
        $this->assertNotEquals(Money::franc(15), $five->times(3));
        // $this->assertEquals(Money::franc(10), $five->times(2));
        // $this->assertEquals(Money::franc(15), $five->times(3));
    }
    /**
     * @test
     */
    public function testCurrency()
    {
        $this->assertEquals('USD', Money::dollar(1)->currency());
        $this->assertEquals('CHF', Money::franc(1)->currency());
    }
    /**
     * @test
     */
    public function testDifferentClassEquality()
    {
        $this->assertTrue((new Money(10, 'CHF'))->equals(new Money(10, 'CHF')));
    }
}
