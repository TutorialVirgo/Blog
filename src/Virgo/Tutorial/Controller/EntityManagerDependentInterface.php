<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;

interface EntityManagerDependentInterface
{
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager);
}
