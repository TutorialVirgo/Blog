<?php

namespace Virgo\Tutorial\Controller\Factory;


use Doctrine\ORM\EntityManager;

class ControllerFactory
{
    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    /**
     * @param string $className
     * @return object
     */
    public function factory($className){

        $className = 'Virgo\Tutorial\Controller\\' . $className;


        if( !class_exists($className)){
            throw new \InvalidArgumentException;
        } else {
            return new $className;
        }
    }

}
