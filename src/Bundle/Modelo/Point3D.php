<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:15
 */

namespace Skilla\VolumesExampleBundle\Modelo;

use Assert\Assertion;

class Point3D extends Point2D implements Point3DInterface
{
    protected $zAxisPosition;

    public function __construct($xAxisPosition, $yAxisPosition, $zAxisPosition)
    {
        parent::__construct($xAxisPosition, $yAxisPosition);
        $this->setZAxisPosition($zAxisPosition);
    }

    protected function setZAxisPosition($zAxisPosition)
    {
        Assertion::integer($zAxisPosition);
        $this->zAxisPosition = $zAxisPosition;
    }

    /**
     * @return integer
     */
    public function zValue()
    {
        return $this->zAxisPosition;
    }
}
