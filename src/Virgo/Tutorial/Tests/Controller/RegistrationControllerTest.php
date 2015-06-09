<?php

namespace Virgo\Tutorial\Tests\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Virgo\Tutorial\Controller\RegistrationController;

class RegistrationControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RegistrationController
     */
    private $controller;

    public function testRegistrationAction()
    {
        $request = new Request();
        $request->setMethod("POST");
        $request->create("registration", "POST", [
            'name' => 'Juhász Ádám',
            'email' => 'juhasz.adam@virgo.hu',
            'passoword' => 'password1'
        ]);
        $request->setSession($this->mockSession());
        $response = $this->getControllerInstance()->registrationAction($request);

        $this->assertTrue($response->getStatusCode() === 200);
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

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function mockSession()
    {
        $mock = $this
            ->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->any())
            ->method('clear');
        $mock->expects($this->any())
            ->method('set');

        return $mock;
    }
}
