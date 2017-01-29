<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:15
 */

namespace Skilla\VolumesExampleBundle\Modelo;

use Assert\Assertion;

class Cuboid implements CuboidInterface
{
    /**
     * @var Point3DInterface $firstVertex
     */
    protected $firstVertex;

    /**
     * @var Point3DInterface $oppositeVertex
     */
    protected $oppositeVertex;

    public function __construct(Point3DInterface $firstVertex, Point3DInterface $oppositeVertex)
    {
        $this->firstVertex = $firstVertex;
        $this->oppositeVertex = $oppositeVertex;
    }

    /**
     * @return Point3DInterface
     */
    public function firstVertex()
    {
        return $this->firstVertex;
    }

    /**
     * @return Point3DInterface
     */
    public function oppositeVertex()
    {
        return $this->oppositeVertex;
    }

    /**
     * @return integer
     */
    public function volume()
    {
        return
            abs($this->firstVertex()->xValue() - $this->oppositeVertex()->xValue())
            * abs($this->firstVertex()->yValue() - $this->oppositeVertex()->yValue())
            * abs($this->firstVertex()->zValue() - $this->oppositeVertex()->zValue());
    }
}
