<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:17
 */

namespace Skilla\VolumesExampleBundle\Modelo;

interface CuboidInterface
{
    /**
     * @return PointInterface
     */
    public function firstVertex();

    /**
     * @return PointInterface
     */
    public function oppositeVertex();

    /**
     * @return integer
     */
    public function volume();
}
