<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:15
 */

namespace Skilla\VolumesExampleBundle\Modelo;

use Assert\Assertion;

class Cube implements CuboidInterface
{
    /**
     * @var PointInterface $position
     */
    protected $position;

    /**
     * @var integer $edgeSize
     */
    protected $edgeSize;

    /**
     * Cube constructor.
     * @param $xAxisPosition
     * @param $yAxisPosition
     * @param $zAxisPosition
     * @param $edgeSize
     */
    public function __construct($xAxisPosition, $yAxisPosition, $zAxisPosition, $edgeSize)
    {
        if (abs($edgeSize)>$edgeSize) {
            $edgeSize = abs($edgeSize);
            $xAxisPosition -= $edgeSize;
            $yAxisPosition -= $edgeSize;
            $zAxisPosition -= $edgeSize;
        }

        $this->setEdgeSize($edgeSize);
        $this->position = new Point3D($xAxisPosition, $yAxisPosition, $zAxisPosition);
    }

    /**
     * @param $edgeSize
     */
    protected function setEdgeSize($edgeSize)
    {
        Assertion::integer($edgeSize);
        $this->edgeSize = $edgeSize;
    }

    /**
     * @return Point3D|PointInterface
     */
    public function firstVertex()
    {
        return $this->position;
    }

    /**
     * @return Point3D
     */
    public function oppositeVertex()
    {
        return new Point3D(
            $this->position->xValue() + $this->edgeSize,
            $this->position->yValue() + $this->edgeSize,
            $this->position->zValue() + $this->edgeSize
        );
    }

    /**
     * @return number
     */
    public function volume()
    {
        return pow($this->edgeSize, 3);
    }

    /**
     * @param CuboidInterface $cube
     * @return Cuboid
     */
    public function intersection(CuboidInterface $cube)
    {
        if (!$this->cubeCollision($cube)) {
            return new Cuboid(new Point3D(0, 0, 0), new Point3D(0, 0, 0));
        }
        return $this->generateCuboidIntersection($cube);
    }

    /**
     * @param CuboidInterface $sut
     * @return bool
     */
    public function cubeCollision(CuboidInterface $sut)
    {
        return
            $this->axesCollision($this->firstVertex()->xValue(), $this->oppositeVertex()->xValue(), $sut->firstVertex()->xValue(), $sut->oppositeVertex()->xValue())
            && $this->axesCollision($this->firstVertex()->yValue(), $this->oppositeVertex()->yValue(), $sut->firstVertex()->yValue(), $sut->oppositeVertex()->yValue())
            && $this->axesCollision($this->firstVertex()->zValue(), $this->oppositeVertex()->zValue(), $sut->firstVertex()->zValue(), $sut->oppositeVertex()->zValue());
    }

    /**
     * @param $objectOneInitial
     * @param $objectOneFinal
     * @param $objectTwoInitial
     * @param $objectTwoFinal
     * @return bool
     */
    private function axesCollision($objectOneInitial, $objectOneFinal, $objectTwoInitial, $objectTwoFinal)
    {
        return
            $this->isIncluded($objectOneFinal, $objectOneFinal, $objectTwoInitial)
            || $this->isIncluded($objectOneInitial, $objectOneFinal, $objectTwoFinal)
            || $this->isIncluded($objectTwoInitial, $objectTwoFinal, $objectOneInitial)
            || $this->isIncluded($objectTwoInitial, $objectTwoFinal, $objectOneFinal);
    }

    /**
     * @param $initialRange
     * @param $endRange
     * @param $position
     * @return bool
     */
    private function isIncluded($initialRange, $endRange, $position)
    {
        return $initialRange < $position && $position < $endRange;
    }

    private function generateCuboidIntersection(CuboidInterface $cube)
    {
        $minXValue = $this->calculateMinValue(
            $this->firstVertex()->xValue(),
            $this->oppositeVertex()->xValue(),
            $cube->firstVertex()->xValue()
        );
        $maxXValue = $this->calculateMaxValue(
            $this->firstVertex()->xValue(),
            $this->oppositeVertex()->xValue(),
            $cube->oppositeVertex()->xValue()
        );
        $minYValue = $this->calculateMinValue(
            $this->firstVertex()->yValue(),
            $this->oppositeVertex()->yValue(),
            $cube->firstVertex()->yValue()
        );
        $maxYValue = $this->calculateMaxValue(
            $this->firstVertex()->yValue(),
            $this->oppositeVertex()->yValue(),
            $cube->oppositeVertex()->yValue()
        );
        $minZValue = $this->calculateMinValue(
            $this->firstVertex()->zValue(),
            $this->oppositeVertex()->zValue(),
            $cube->firstVertex()->zValue()
        );
        $maxZValue = $this->calculateMaxValue(
            $this->firstVertex()->zValue(),
            $this->oppositeVertex()->zValue(),
            $cube->oppositeVertex()->zValue()
        );
        return new Cuboid(new Point3D($minXValue, $minYValue, $minZValue), new Point3D($maxXValue, $maxYValue, $maxZValue));
    }

    /**
     * @param integer $objectOneInitial
     * @param integer $objectOneFinal
     * @param integer $objectTwoInitial
     * @return integer
     */
    private function calculateMinValue($objectOneInitial, $objectOneFinal, $objectTwoInitial)
    {
        if ($objectOneInitial <= $objectTwoInitial && $objectTwoInitial <= $objectOneFinal) {
            return $objectTwoInitial;
        }
        return $objectOneInitial;
    }

    /**
     * @param integer $objectOneInitial
     * @param integer $objectOneFinal
     * @param integer $objectTwoFinal
     * @return integer
     */
    private function calculateMaxValue($objectOneInitial, $objectOneFinal, $objectTwoFinal)
    {
        if ($objectOneInitial <= $objectTwoFinal && $objectTwoFinal <= $objectOneFinal) {
            return $objectTwoFinal;
        }
        return $objectOneFinal;
    }
}
