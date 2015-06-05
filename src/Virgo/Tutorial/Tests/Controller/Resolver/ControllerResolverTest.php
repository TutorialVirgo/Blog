<?php

namespace Virgo\Tutorial\Test\Controller\Resolver;

use Doctrine\ORM\EntityManager;
use Virgo\Tutorial\Controller\DefaultController;
use Virgo\Tutorial\Controller\RegistrationController;
use Virgo\Tutorial\Controller\Resolver\ControllerResolver;

class ControllerResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ControllerResolver
     */
    private $resolver;

    public function testResolveIsCallable()
    {
        $this->assertTrue(is_callable($this->getResolverInstance()->resolve("DefaultController::indexAction",$this->mockEntityManager())));
    }

    /**
     * @dataProvider controllerProvider
     */
    public function testResolveIndexAction($expected, $controllerString)
    {
        $resolvedController = $this->getResolverInstance()->resolve($controllerString, $this->mockEntityManager());
        $this->assertInstanceOf($expected[0], $resolvedController[0]);
        $this->assertSame($expected[1], $resolvedController[1]);
    }

    /**
     * @return array
     */
    public function controllerProvider()
    {
        return [
            ["expected" => [DefaultController::class, "indexAction"], "controller" => "DefaultController::indexAction"],
            ["expected" => [DefaultController::class, "updateAction"], "controller" => "DefaultController::updateAction"],
            ["expected" => [RegistrationController::class, "registerAction"], "controller" => "RegistrationController::registerAction"]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testResolveExceptionThrown()
    {
        $this->getResolverInstance()->resolve("UndefinedController::registerAction",$this->mockEntityManager());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testResolveInvalidArgumentExceptionThrown()
    {
        $this->getResolverInstance()->resolve(new \Stdclass(),$this->mockEntityManager());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testResolveArrayArgumentExceptionThrown()
    {
        $this->getResolverInstance()->resolve([], $this->mockEntityManager());
    }

    /**
     * @return ControllerResolver
     */
    public function getResolverInstance()
    {
        if ($this->resolver === null) {
            $this->resolver = new ControllerResolver();
        }

        return $this->resolver;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function mockEntityManager()
    {
        return $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
