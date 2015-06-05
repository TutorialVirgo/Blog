<?php

namespace Virgo\Tutorial\Entity;

/**
 * @Table(name="user")
 * @Entity
 **/
class User extends AbstractEntity
{
    /**
     * @Column(type="string", length=64, nullable=false)
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", length=128 ,nullable=false, unique=true)
     * @var string
     */
    protected $email;

    /**
     * @Column(type="string", length=40 ,nullable=false)
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $salt;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password . $this->salt, PASSWORD_BCRYPT);
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function generateSalt()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString = $characters[rand(0, strlen($characters) - 1)];
        }

        $this->salt = $randomString;
    }
}
