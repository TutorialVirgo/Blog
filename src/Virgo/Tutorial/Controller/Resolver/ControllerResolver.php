<?php

namespace Virgo\Tutorial\Controller\Resolver;

use Doctrine\ORM\EntityManager;
use Virgo\Tutorial\Controller\DefaultController;
use Virgo\Tutorial\Controller\Factory\ControllerFactory;
use Virgo\Tutorial\Controller\PostController;
use Virgo\Tutorial\Controller\RegistrationController;

class ControllerResolver
{
    /**
     * @param string         $result
     * @param  EntityManager $em
     * @return DefaultController|RegistrationController|PostController
     */
    public function resolve($result, $em)
    {
        if (!is_string($result)) {
            throw new \InvalidArgumentException;
        }

        list($className, $method) = explode('::', $result);
        $controllerFactory = new ControllerFactory($em);
        $controller = $controllerFactory->factory($className);

        return [$controller, $method];
    }
}
