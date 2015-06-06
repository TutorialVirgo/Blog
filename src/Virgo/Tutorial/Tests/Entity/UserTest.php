<?php

namespace Virgo\Tutorial\Tests\Entity;

use Virgo\Tutorial\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testPasswordIsHash()
    {
        $user = new User();
        $user->setPassword("TestPassword");

        $this->assertTrue(strlen($user->getPassword()) == 60);
    }

    public function testSalt()
    {
        $user = new User();

        $this->assertTrue(strlen($user->getSalt()) == 10);
    }
}
