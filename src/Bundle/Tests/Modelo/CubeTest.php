<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 10:14
 */

namespace Skilla\VolumesExampleBundle\Tests\Modelo\Point;

use Skilla\VolumesExampleBundle\Modelo\Cube;
use Skilla\VolumesExampleBundle\Modelo\Point3D;

class CubeTest extends \PHPUnit_Framework_TestCase
{
    const X_VALUE = 3;
    const Y_VALUE = -2;
    const Z_VALUE = 5;
    const EDGE_VALUE = 7;
    const NEGATIVE_EDGE_VALUE = 1;

    public function testInstantiation()
    {
        $sut = $this->getNewCube();
        $this->assertInstanceOf(Cube::class, $sut);
    }

    public function testFirstVertex()
    {
        $sut = $this->getNewCube();
        $this->assertEquals(
            $sut->firstVertex(),
            new Point3D(self::X_VALUE, self::Y_VALUE, self::Z_VALUE)
        );
    }

    public function testFirstVertexWithNegaliveLength()
    {
        $sut = $this->getNewCubeWithNegativeLength();
        $this->assertEquals(
            $sut->firstVertex(),
            new Point3D(
                self::X_VALUE - self::NEGATIVE_EDGE_VALUE,
                self::Y_VALUE - self::NEGATIVE_EDGE_VALUE,
                self::Z_VALUE - self::NEGATIVE_EDGE_VALUE
            )
        );
    }

    public function testOppositeVertex()
    {
        $sut = $this->getNewCube();
        $this->assertEquals(
            $sut->oppositeVertex(),
            new Point3D(
                self::X_VALUE + self::EDGE_VALUE,
                self::Y_VALUE + self::EDGE_VALUE,
                self::Z_VALUE + self::EDGE_VALUE
            )
        );
    }

    public function testOppositeVertexWithNegativeLength()
    {
        $sut = $this->getNewCubeWithNegativeLength();
        $this->assertEquals($sut->oppositeVertex(), new Point3D(self::X_VALUE, self::Y_VALUE, self::Z_VALUE));
    }

    public function testVolume()
    {
        $sut = $this->getNewCube();
        $this->assertEquals(343, $sut->volume());
    }

    /**
     * @return Cube
     */
    protected function getNewCube()
    {
        return new Cube(self::X_VALUE, self::Y_VALUE, self::Z_VALUE, self::EDGE_VALUE);
    }

    /**
     * @return Cube
     */
    protected function getNewCubeWithNegativeLength()
    {
        return new Cube(self::X_VALUE, self::Y_VALUE, self::Z_VALUE, -self::NEGATIVE_EDGE_VALUE);
    }

    public function testVolumeIntersection()
    {
        $firstCube = new Cube(0, 0, 0, 5);
        $secondCube = new Cube(4, 4, 4, 5);
        $intersection = $firstCube->intersection($secondCube);
        $this->assertEquals(1, $intersection->volume());
    }

    public function testVolumeIntersectionWhenInterchagePositions()
    {
        $firstCube = new Cube(0, 0, 0, 5);
        $secondCube = new Cube(4, 4, 4, 5);
        $intersection = $secondCube->intersection($firstCube);
        $this->assertEquals(1, $intersection->volume());
    }

    public function testVolumeIntersectionWhenNoCollision()
    {
        $firstCube = new Cube(0, 0, 0, 5);
        $secondCube = new Cube(6, 6, 6, 5);
        $intersection = $firstCube->intersection($secondCube);
        $this->assertEquals(0, $intersection->volume());
    }

    public function testVolumeIntersectionWhenIncludedCube()
    {
        $firstCube = new Cube(0, 0, 0, 5);
        $secondCube = new Cube(1, 1, 1, 3);
        $intersection = $firstCube->intersection($secondCube);
        $this->assertEquals(27, $intersection->volume());
    }
}
