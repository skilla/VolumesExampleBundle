<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 10:14
 */

namespace Skilla\VolumesExampleBundle\Tests\Modelo\Point;

use Skilla\VolumesExampleBundle\Modelo\Cube;
use Skilla\VolumesExampleBundle\Modelo\Cuboid;
use Skilla\VolumesExampleBundle\Modelo\Point3D;

class CuboidTest extends \PHPUnit_Framework_TestCase
{
    const X1_VALUE = 3;
    const Y1_VALUE = -2;
    const Z1_VALUE = 5;

    const X2_VALUE = 2;
    const Y2_VALUE = 4;
    const Z2_VALUE = 8;

    public function testInstantiation()
    {
        $sut = $this->getNewCuboid();
        $this->assertInstanceOf(Cuboid::class, $sut);
    }

    public function testFirstVertex()
    {
        $sut = $this->getNewCuboid();
        $this->assertEquals(
            $sut->firstVertex(),
            new Point3D(self::X1_VALUE, self::Y1_VALUE, self::Z1_VALUE)
        );
    }

    public function testOppositeVertex()
    {
        $sut = $this->getNewCuboid();
        $this->assertEquals($sut->oppositeVertex(), new Point3D(self::X2_VALUE, self::Y2_VALUE, self::Z2_VALUE));
    }

    public function testVolume()
    {
        $sut = $this->getNewCuboid();
        $this->assertEquals(18, $sut->volume());
    }

    /**
     * @return Point3D
     */
    protected function firstVertex()
    {
        return new Point3D(self::X1_VALUE, self::Y1_VALUE, self::Z1_VALUE);
    }

    /**
     * @return Point3D
     */
    protected function oppositeVertex()
    {
        return new Point3D(self::X2_VALUE, self::Y2_VALUE, self::Z2_VALUE);
    }

    /**
     * @return Cube
     */
    protected function getNewCuboid()
    {
        return new Cuboid($this->firstVertex(), $this->oppositeVertex());
    }
}
