<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 30/10/16
 * Time: 15:16
 */

namespace Skilla\VolumesExampleBundle\Tests;

use \Skilla\VolumesExampleBundle\SkillaVolumesExampleBundle;
use \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SkillaVolumesExampleBundleTest extends KernelTestCase
{
    public function testInstantiation()
    {
        $expected = 'Symfony\\Component\\HttpKernel\\Bundle\\Bundle';
        $actual = new SkillaVolumesExampleBundle();
        $this->assertInstanceOf($expected, $actual);
    }
}
