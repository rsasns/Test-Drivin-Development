<?php
namespace tests\chapter21;

use Exception;

class TestResult
{
    function __construct()
    {
        $this->runCount = 0;
    }

    function testStarted()
    {
        $this->runCount + 1;
    }

    function summary()
    {
        return $this->runCount . ' run, 0 failed';
    }
}

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
        $result = new TestResult;
        $result->testStarted();
        $this->setUp();
        $this->{$this->name}();
        $this->tearDown();
        return $result;
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
    
    function testBrokenMethod()
    {
        throw new Exception;
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

    function testResult()
    {
        $test = new WasRun('testMethod');
        $result = $test->run();
        assert('1 run, 0 failed' === $result->summary());
    }

    function testFailedResult()
    {
        $test = new WasRun('testBrokenMethod');
        $result = $test->run();
        assert('1 run, 1 failed' === $result->summary());
    }
}

(new TestCaseTest('testTemplateMethod'))->run();
(new TestCaseTest('testResult'))->run();
// (new TestCaseTest('testFailedResult'))->run();