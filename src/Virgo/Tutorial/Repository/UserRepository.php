<?php

namespace Virgo\Tutorial\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findByEmail($email)
    {
        return $this->findOneBy(['email' => $email]);
    }
}
