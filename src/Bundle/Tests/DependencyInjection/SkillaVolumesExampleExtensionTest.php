<?php
/**
 * Created by PhpStorm.
 * User: Skilla <sergio.zambrano@gmail.com>
 * Date: 8/10/16
 * Time: 21:07
 */

namespace Skilla\VolumesExampleBundle\Tests\DependencyInjection;

use \Skilla\VolumesExampleBundle\DependencyInjection\SkillaVolumesExampleExtension;
use \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class SkillaVolumesExampleExtensionTest extends KernelTestCase
{
    const FALSE = false;

    public function testInstantiation()
    {
        $expected = 'Symfony\\Component\\HttpKernel\\DependencyInjection\\Extension';
        $actual = new SkillaVolumesExampleExtension();
        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadWhitNoKernelParameter()
    {
        $parameters = array();
        $parameterBag = new ParameterBag($parameters);
        $containerBuilder = new ContainerBuilder($parameterBag);
        $sut = new SkillaVolumesExampleExtension();

        $sut->load(array(array()), $containerBuilder);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadWhitNoBundleParameter()
    {
        $parameters = $this->getBasicParameters();
        $parameterBag = new ParameterBag($parameters);
        $containerBuilder = new ContainerBuilder($parameterBag);
        $sut = new SkillaVolumesExampleExtension();

        $configs = array(array());
        $sut->load($configs, $containerBuilder);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadWithInvalidParameter()
    {
        $parameters = $this->getBasicParameters();
        $parameterBag = new ParameterBag($parameters);
        $containerBuilder = new ContainerBuilder($parameterBag);
        $sut = new SkillaVolumesExampleExtension();

        $configs = array(
            array(
                'type' => null,
            )
        );
        $sut->load($configs, $containerBuilder);
    }

    public function testLoad()
    {
        static::bootKernel();

        $parameters = array(
            'kernel.root_dir' => static::$kernel->getRootDir(),
            'kernel.debug' => static::$kernel->isDebug(),
        );
        $parameterBag = new ParameterBag($parameters);
        $containerBuilder = new ContainerBuilder($parameterBag);
        $sut = new SkillaVolumesExampleExtension();

        $configs = array(
            array(
                'key' => 'value',
            )
        );
        $sut->load($configs, $containerBuilder);
        $this->assertEquals('skilla_volumes_example', $sut->getAlias());
        parent::tearDown();
    }

    /**
     * @return array
     */
    private function getBasicParameters()
    {
        return array(
            'kernel.root_dir' => realpath(__DIR__ . '/app/'),
            'kernel.debug' => self::FALSE,
        );
    }
}
