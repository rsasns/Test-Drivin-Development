<?php
namespace tests\chapter19;

class TestCase
{
    function __construct($name)
    {
        $this->name = $name;
    }

    function setUp()
    {
    }

    function run()
    {
        $this->setUp();
        $this->{$this->name}();
    }
}

class WasRun extends TestCase
{
    function setUp()
    {
        $this->wasRun = null;
        $this->wasSetUp = 1;
    }

    function testMethod()
    {
        $this->wasRun = 1;
    }
}

class TestCaseTest extends TestCase
{
    function setUp()
    {
        $this->test = new WasRun('testMethod');
    }

    function testRunning()
    {
        $this->test->run();
        assert($this->test->wasRun);
    }

    function testSetUp()
    {
        $this->test->run();
        assert($this->test->wasSetUp);
    }
}

(new TestCaseTest('testRunning'))->run();
(new TestCaseTest('testSetUp'))->run();