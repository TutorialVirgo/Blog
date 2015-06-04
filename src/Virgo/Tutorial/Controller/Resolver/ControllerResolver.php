<?php

namespace Virgo\Tutorial\Controller\Resolver;

use Virgo\Tutorial\Controller\DefaultController;
use Virgo\Tutorial\Controller\Factory\ControllerFactory;
use Virgo\Tutorial\Controller\RegistrationController;

class ControllerResolver
{
    /**
     * @param string $result
     * @return DefaultController|RegistrationController
     */
    public function resolve($result)
    {
        if (!is_string($result)) {
            throw new \InvalidArgumentException;
        }

        list($className, $method) = explode('::', $result);
        $controllerFactory = new ControllerFactory();
        $controllerFactory->factory($className);

        if( !class_exists($className)){
            throw new \InvalidArgumentException;
        }

        return [new $className, $method];
    }
}
