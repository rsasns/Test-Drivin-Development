<?php

namespace tests\chapter1;

use PHPUnit\Framework\TestCase;
use src\chapter1\Dollar;

Class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function testMultipication()
    {
        $five = new Dollar(5);
        $five->times(2);
        $this->assertEquals(10, $five->amount);
    }
}
