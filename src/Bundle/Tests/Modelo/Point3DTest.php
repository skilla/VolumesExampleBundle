<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:42
 */

namespace Skilla\VolumesExampleBundle\Tests\Modelo\Point;

use Assert\InvalidArgumentException;
use Skilla\VolumesExampleBundle\Modelo\Point3D;

class Point3DTest extends \PHPUnit_Framework_TestCase
{
    const VALID_VALUE = 0;
    const INVALID_VALUE = 0.5;

    const XAXISPOSITION = 3;

    const YAXISPOSITION = 5;

    const ZAXISPOSITION = 7;

    public function testInstantiation()
    {
        $sut = new Point3D(self::VALID_VALUE, self::VALID_VALUE, self::VALID_VALUE);
        $this->assertInstanceOf(Point3D::class, $sut);
    }

    /**
     * @@expectedException InvalidArgumentException
     */
    public function testValueXAreInteger()
    {
        new Point3D(self::INVALID_VALUE, self::VALID_VALUE, self::VALID_VALUE);
    }

    /**
     * @@expectedException InvalidArgumentException
     */
    public function testValueYAreInteger()
    {
        new Point3D(self::VALID_VALUE, self::INVALID_VALUE, self::VALID_VALUE);
    }


    /**
     * @@expectedException InvalidArgumentException
     */
    public function testValueZAreInteger()
    {
        new Point3D(self::VALID_VALUE, self::VALID_VALUE, self::INVALID_VALUE);
    }

    public function testReturnedValues()
    {
        $sut = new Point3D(self::XAXISPOSITION, self::YAXISPOSITION, self::ZAXISPOSITION);
        $this->assertEquals(self::XAXISPOSITION, $sut->xValue());
        $this->assertEquals(self::YAXISPOSITION, $sut->yValue());
        $this->assertEquals(self::ZAXISPOSITION, $sut->zValue());
    }
}
