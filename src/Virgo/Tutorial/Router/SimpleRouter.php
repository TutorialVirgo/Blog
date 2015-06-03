<?php

namespace Virgo\Tutorial\Router;

use Virgo\Tutorial\Controller\DefaultController;
use Virgo\Tutorial\Controller\RegistrationController;

class SimpleRouter
{
    /**
     * @param $route
     * @return array
     * @throws \Exception
     */
    public function getController($route)
    {
        switch ($route) {
            case "/" : {
                return [new DefaultController(), 'indexAction'];
                break;
            }
            case "/registration" : {
                return [new RegistrationController(), 'registrationAction'];
                break;
            }
            default : {
                throw new \Exception("NIY");
                break;
            }
        }
    }
}
