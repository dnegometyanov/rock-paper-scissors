<?php

namespace SampleTest\Unit;

use PHPUnit\Framework\TestCase;
use Sample\Hello\SampleClass;

/**
 * Class InvestmentTest
 */
class SampleClassTest extends TestCase
{
    public function testSampleClassConstruct()
    {
        $sampleClass = new SampleClass();

        $this->assertInstanceOf(SampleClass::class, $sampleClass);
    }

    public function testSampleClassSampleMethod()
    {
        $sampleClass = new SampleClass();

        $result = $sampleClass->sampleMethod();

        $this->assertEquals('Hello World', $result);
    }
}