<?php
namespace tests\chapter20;

class TestCase
{
    function __construct($name)
    {
        $this->name = $name;
    }
    
    function setUp() {}

    function tearDown() {}

    function run()
    {
        $this->setUp();
        $this->{$this->name}();
        $this->tearDown();
    }
}

class WasRun extends TestCase
{
    function setUp()
    {
        $this->log = 'setUp ';
    }

    function testMethod()
    {
        $this->log = $this->log . 'testMethod ';
    }
    
    function tearDown()
    {
        $this->log = $this->log . 'tearDown ';
    }
}

class TestCaseTest extends TestCase
{
    function testTemplateMethod()
    {
        $test = new WasRun('testMethod');
        $test->run();
        assert('setUp testMethod tearDown ' === $test->log);
    }
}

(new TestCaseTest('testTemplateMethod'))->run();