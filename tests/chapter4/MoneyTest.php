<?php
namespace tests\chapter4;

use PHPUnit\Framework\TestCase;
use src\chapter4\Dollar;

Class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function testMultipication()
    {
        $five = new Dollar(5);
        $this->assertEquals(new Dollar(10), $five->times(2));
        $this->assertEquals(new Dollar(15), $five->times(3));
    }
    /**
     * @test
     */
    public function testEquality()
    {
        $this->assertTrue((new Dollar(5))->equals(new Dollar(5)));
        $this->assertFalse((new Dollar(5))->equals(new Dollar(6)));
    }
}
