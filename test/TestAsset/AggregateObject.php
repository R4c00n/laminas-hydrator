<?php

/**
 * @see       https://github.com/laminas/laminas-hydrator for the canonical source repository
 * @copyright https://github.com/laminas/laminas-hydrator/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-hydrator/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace LaminasTest\Hydrator\TestAsset;

/**
 * Test asset to verify that a composition of a class-methods and an array-serializable
 * hydrator produces the expected output
 */
class AggregateObject
{
    /**
     * @var array
     */
    public $arrayData  = ['president' => 'Zaphod'];

    /**
     * @var string
     */
    public $maintainer = 'Marvin';

    /**
     * @return string
     */
    public function getMaintainer()
    {
        return $this->maintainer;
    }

    /**
     * @param string $maintainer
     *
     * @return void
     */
    public function setMaintainer($maintainer): void
    {
        $this->maintainer = $maintainer;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->arrayData;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function exchangeArray(array $data): void
    {
        $this->arrayData = $data;
    }
}
