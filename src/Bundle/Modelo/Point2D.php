<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:15
 */

namespace Skilla\VolumesExampleBundle\Modelo;

use Assert\Assertion;

class Point2D implements Point2DInterface
{
    protected $xAxisPosition;

    protected $yAxisPosition;

    public function __construct($xAxisPosition, $yAxisPosition)
    {
        $this->setXAxisPosition($xAxisPosition);
        $this->setYAxisPosition($yAxisPosition);
    }

    protected function setXAxisPosition($xAxisPosition)
    {
        Assertion::integer($xAxisPosition);
        $this->xAxisPosition = $xAxisPosition;
    }

    protected function setYAxisPosition($yAxisPosition)
    {
        Assertion::integer($yAxisPosition);
        $this->yAxisPosition = $yAxisPosition;
    }

    /**
     * @return integer
     */
    public function xValue()
    {
        return $this->xAxisPosition;
    }

    /**
     * @return integer
     */
    public function yValue()
    {
        return $this->yAxisPosition;
    }
}
