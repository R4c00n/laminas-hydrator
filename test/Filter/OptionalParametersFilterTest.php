<?php

/**
 * @see       https://github.com/laminas/laminas-hydrator for the canonical source repository
 * @copyright https://github.com/laminas/laminas-hydrator/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-hydrator/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace LaminasTest\Hydrator\Filter;

use InvalidArgumentException;
use Laminas\Hydrator\Filter\OptionalParametersFilter;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for {@see OptionalParametersFilter}
 *
 * @covers \Laminas\Hydrator\Filter\OptionalParametersFilter
 */
class OptionalParametersFilterTest extends TestCase
{
    /**
     * @var OptionalParametersFilter
     */
    protected $filter;

    /**
     * {@inheritDoc}
     */
    protected function setUp() : void
    {
        $this->filter = new OptionalParametersFilter();
    }

    /**
     * Verifies a list of methods against expected results
     *
     * @param string $method
     * @param bool   $expectedResult
     *
     * @dataProvider methodProvider
     *
     * @return void
     */
    public function testMethods($method, $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->filter->filter($method));
    }

    /**
     * Verifies a list of methods against expected results over subsequent calls, checking
     * that the filter behaves consistently regardless of cache optimizations
     *
     * @param string $method
     * @param bool   $expectedResult
     *
     * @dataProvider methodProvider
     *
     * @return void
     */
    public function testMethodsOnSubsequentCalls($method, $expectedResult): void
    {
        for ($i = 0; $i < 5; $i += 1) {
            $this->assertSame($expectedResult, $this->filter->filter($method));
        }
    }

    public function testTriggersExceptionOnUnknownMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->filter->filter(__CLASS__ . '::' . 'nonExistingMethod');
    }

    /**
     * Provides a list of methods to be checked against the filter
     *
     * @return array
     */
    public function methodProvider()
    {
        return [
            [__CLASS__ . '::' . 'methodWithoutParameters', true],
            [__CLASS__ . '::' . 'methodWithSingleMandatoryParameter', false],
            [__CLASS__ . '::' . 'methodWithSingleOptionalParameter', true],
            [__CLASS__ . '::' . 'methodWithMultipleMandatoryParameters', false],
            [__CLASS__ . '::' . 'methodWithMultipleOptionalParameters', true],
        ];
    }

    /**
     * Test asset method
     *
     * @return void
     */
    public function methodWithoutParameters(): void
    {
    }

    /**
     * Test asset method
     *
     * @return void
     */
    public function methodWithSingleMandatoryParameter($parameter): void
    {
    }

    /**
     * Test asset method
     *
     * @return void
     */
    public function methodWithSingleOptionalParameter($parameter = null): void
    {
    }

    /**
     * Test asset method
     *
     * @return void
     */
    public function methodWithMultipleMandatoryParameters($parameter, $otherParameter): void
    {
    }

    /**
     * Test asset method
     *
     * @return void
     */
    public function methodWithMultipleOptionalParameters($parameter = null, $otherParameter = null): void
    {
    }
}
