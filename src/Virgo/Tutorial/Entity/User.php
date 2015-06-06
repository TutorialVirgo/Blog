<?php

namespace Virgo\Tutorial\Entity;

/**
 * @Table(name="user")
 * @Entity(repositoryClass="Virgo\Tutorial\Repository\UserRepository")
 **/
class User extends AbstractEntity
{
    /**
     * @Column(type="string", length=64, nullable=false)
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", length=256 ,nullable=false, unique=true)
     * @var string
     */
    protected $email;

    /**
     * @Column(type="string", length=40 ,nullable=false)
     * @var string
     */
    protected $password;

    /**
     * @Column(type="string", length=60 ,nullable=false)
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
        $this->generateSalt();

        $this->password = password_hash($password, PASSWORD_BCRYPT, ['salt' => $this->salt]);
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    private function generateSalt()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 22; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $this->salt = $randomString;
    }
}
