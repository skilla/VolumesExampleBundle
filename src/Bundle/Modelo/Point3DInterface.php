<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:17
 */

namespace Skilla\VolumesExampleBundle\Modelo;

interface Point3DInterface extends Point2DInterface
{
    /**
     * @return integer
     */
    public function zValue();
}
