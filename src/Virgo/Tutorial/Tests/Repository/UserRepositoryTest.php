<?php

namespace Virgo\Tutorial\Tests\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Virgo\Tutorial\Entity\User;
use Virgo\Tutorial\Repository\UserRepository;

class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{

    public function testFindByEmail()
    {
        $mockedEntityManager = $this->mockEntityManager();
        $mockedEntityManager->expects($this->once())
            ->method('find')
            ->will($this->returnValue(new User()));

        $repository = new UserRepository($mockedEntityManager, new ClassMetadata(User::class));
        $this->assertEquals($repository->findByEmail('foo'), new User);
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
