<?php
namespace tests\chapter18;

class TestCase
{
    function __construct($name)
    {
        $this->name = $name;
    }

    function run()
    {
        $this->{$this->name}();
    }
}

class WasRun extends TestCase
{
    function __construct($name)
    {
        $this->wasRun = null;
        parent::__construct($name);
    }

    function testMethod()
    {
        $this->wasRun = 1;
    }
}

class TestCaseTest extends TestCase
{
    function testRunning()
    {
        $test = new WasRun('testMethod');
        assert(!$test->wasRun);
        $test->run();
        assert($test->wasRun);
    }
}

(new TestCaseTest('testRunning'))->run();