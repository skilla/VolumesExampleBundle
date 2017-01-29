<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 29/1/17
 * Time: 9:17
 */

namespace Skilla\VolumesExampleBundle\Modelo;

interface Point2DInterface
{
    /**
     * @return integer
     */
    public function xValue();

    /**
     * @return integer
     */
    public function yValue();
}
