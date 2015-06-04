<?php

namespace Virgo\Tutorial\Tests\Controller;


use Doctrine\ORM\EntityManager;
use Virgo\Tutorial\Controller\RegistrationController;

class RegistrationControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RegistrationController
     */
    private $controller;

    public function testRegistrationAction()
    {

    }

    /**
     * @return RegistrationController
     */
    private function  getControllerInstance()
    {
        if ($this->controller === null) {
            $mockedEntityManager = $this->mockEntityManager();
            $mockedEntityManager->expects($this->any())
                ->method('getRepository')
                ->will($this->returnValue([]));

            /** @var  EntityManager $mockedEntityManager */
            $this->controller = new RegistrationController($mockedEntityManager);
        }

        return $this->controller;
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
