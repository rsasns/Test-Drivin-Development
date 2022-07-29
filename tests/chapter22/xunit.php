<?php
namespace tests\chapter22;

use Exception;

class TestResult
{
    function __construct()
    {
        $this->runCount = 0;
        $this->errorCount = 0;
    }

    function testStarted()
    {
        $this->runCount++;
    }

    function testFailed()
    {
        $this->errorCount++;
    }

    function summary()
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
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
        try {
            $this->{$this->name}();
        } catch (Exception $e) {
            $result->testFailed();
        }
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

    function testFailedResultFormatting()
    {
        $result = new TestResult;
        $result->testStarted();
        $result->testFailed();
        assert('1 run, 1 failed' === $result->summary());
    }
}

print((new TestCaseTest('testTemplateMethod'))->run()->summary());
print((new TestCaseTest('testResult'))->run()->summary());
print((new TestCaseTest('testFailedResult'))->run()->summary());
print((new TestCaseTest('testFailedResultFormatting'))->run()->summary());
