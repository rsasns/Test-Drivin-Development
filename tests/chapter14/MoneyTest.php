<?php
namespace tests\chapter14;

use PHPUnit\Framework\TestCase;
use src\chapter14\Bank;
use src\chapter14\Money;
use src\chapter14\Sum;

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
    /**
     * @test
     */
    public function testSimpleAddition()
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $bank = new Bank();
        $reduced = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(10), $reduced);
    }
    /**
     * @test
     */
    public function testPlusReturnsSum()
    {
        $five = Money::dollar(5);
        /** @var \src\chapter14\Expression $result */
        $result = $five->plus($five);
        /** @var \src\chapter14\Sum $sum*/
        $sum = $result;
        $this->assertEquals($five, $sum->augend);
        $this->assertEquals($five, $sum->addend);
    }
    /**
     * @test
     */
    public function testReduceSum()
    {
        $sum = new Sum(Money::dollar(3), Money::dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(7), $result);
    }
    /**
     * @test
     */
    public function testReduceMoney()
    {
        $bank = new Bank();
        $result = $bank->reduce(Money::dollar(1), 'USD');
        $this->assertEquals(Money::dollar(1), $result);
    }
    /**
     * @test
     */
    public function testReduceMoneyDiffrentCurrency()
    {
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $result = $bank->reduce(Money::franc(2), 'USD');
        $this->assertEquals(Money::dollar(1), $result);
    }
    /**
     * @test
     */
    public function testIdentityRate()
    {
        $this->assertEquals(1, (new Bank())->rate('USD', 'USD'));
    }
}
