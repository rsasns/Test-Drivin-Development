<?php
namespace tests\chapter23;

use Exception;

class TestCaseTest extends TestCase
{
    function setUp()
    {
        $this->result = new TestResult;
    }

    function testTemplateMethod()
    {
        $test = new WasRun('testMethod');
        $test->run($this->result);
        assert('setUp testMethod tearDown ' === $test->log);
    }

    function testResult()
    {
        $test = new WasRun('testMethod');
        $test->run($this->result);
        assert('1 run, 0 failed' === $this->result->summary());
    }

    function testFailedResult()
    {
        $test = new WasRun('testBrokenMethod');
        $test->run($this->result);
        assert('1 run, 1 failed' === $this->result->summary());
    }

    function testFailedResultFormatting()
    {
        $this->result->testStarted();
        $this->result->testFailed();
        assert('1 run, 1 failed' === $this->result->summary());
    }

    function testSuite()
    {
        $suite = new TestSuite;
        $suite->add(new WasRun('testMethod'));
        $suite->add(new WasRun('testBrokenMethod'));
        $suite->run($this->result);
        assert('2 run, 1 failed' == $this->result->summary());
    }
}

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

    function run($result)
    {
        $result->testStarted();
        $this->setUp();
        try {
            $this->{$this->name}();
        } catch (Exception $e) {
            $result->testFailed();
        }
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
    
    function testBrokenMethod()
    {
        throw new Exception;
    }

    function tearDown()
    {
        $this->log = $this->log . 'tearDown ';
    }
}

class TestSuite
{
    function __construct()
    {
        $this->tests = [];
    }

    function add($test)
    {
        array_push($this->tests, $test);
    }

    function run($result)
    {
        foreach ($this->tests as $test) {
            $test->run(($result));
        }
    }
}

$suite = new TestSuite;
$suite->add(new TestCaseTest('testTemplateMethod'));
$suite->add(new TestCaseTest('testResult'));
$suite->add(new TestCaseTest('testFailedResult'));
$suite->add(new TestCaseTest('testFailedResultFormatting'));
$suite->add(new TestCaseTest('testSuite'));
$result = new TestResult;
$suite->run($result);
print($result->summary());