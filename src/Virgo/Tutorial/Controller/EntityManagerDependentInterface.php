<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;

interface EntityManagerDependentInterface
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em);
}
