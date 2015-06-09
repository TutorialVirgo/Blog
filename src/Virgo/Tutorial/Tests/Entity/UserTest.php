<?php

namespace Virgo\Tutorial\Tests\Entity;

use Virgo\Tutorial\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testSettersGettes()
    {
        $date = new \DateTime();

        $user = new User();
        $user->setPassword("password1");
        $user->setEmail("email@mailer.com");
        $user->setName("Foo Bar");
        $user->setPlainPassword("plainpassword1");
        $user->setModifiedDate($date);
        $user->setStatus("Active");

        $this->assertTrue(strlen($user->getPassword()) === 60);
        $this->assertSame("Foo Bar", $user->getName());
        $this->assertSame("email@mailer.com", $user->getEmail());
        $this->assertSame("plainpassword1", $user->getPlainPassword());
        $this->assertSame($date, $user->getModifiedDate());
        $this->assertInstanceOf(\DateTime::class, $user->getCreatedDate());
        $this->assertSame("Active", $user->getStatus());
        $this->assertTrue(strlen($user->getSalt()) === 22);

        $user->setParamteres("Bar Foo","email@foobar.com","password1", "Inactive");
    }
}
