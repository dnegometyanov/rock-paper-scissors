<?php declare(strict_types=1);

namespace SampleTest\Unit;

use PHPUnit\Framework\TestCase;
use Sample\Hello\SampleClass;

/**
 * Class InvestmentTest
 */
class SampleClassTest extends TestCase
{
    public function testSampleClassConstruct(): void
    {
        $sampleClass = new SampleClass();

        $this->assertInstanceOf(SampleClass::class, $sampleClass);
    }

    public function testSampleClassSampleMethod(): void
    {
        $sampleClass = new SampleClass();

        $result = $sampleClass->sampleMethod();

        $this->assertEquals('Hello World', $result);
    }
}