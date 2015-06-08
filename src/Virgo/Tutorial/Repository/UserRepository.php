<?php

namespace Virgo\Tutorial\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param string $email
     * @return null|object
     */
    public function findByEmail($email)
    {
        return $this->findOneBy(['email' => $email]);
    }
}
