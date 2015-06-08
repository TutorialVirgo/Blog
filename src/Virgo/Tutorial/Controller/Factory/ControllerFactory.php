<?php

namespace Virgo\Tutorial\Controller\Factory;


use Doctrine\ORM\EntityManager;
use Virgo\Tutorial\Controller\EntityManagerDependentInterface;

class ControllerFactory
{
    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $className
     * @return object
     */
    public function factory($className)
    {
        $className = 'Virgo\Tutorial\Controller\\' . $className;

        if (!class_exists($className)) {
            echo $className." does not exists.";
            throw new \InvalidArgumentException;
        } else {
            if (in_array(EntityManagerDependentInterface::class, (class_implements($className)))) {
                return new $className($this->em);
            }

            return new $className;
        }
    }
}
