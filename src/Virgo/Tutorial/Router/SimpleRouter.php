<?php

namespace Virgo\Tutorial\Router;

use Virgo\Tutorial\Controller\DefaultController;

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
                //$response->setContent(file_get_contents(__DIR__ . '/../src/Virgo/Tutorial/Resources/Views/index.html'));
                return [new DefaultController(), 'indexAction'];
                break;
            }
            case "/registration" : {
                // $controller->setContent(__DIR__ . '/../src/Virgo/Tutorial/Resources/Views/registration.html');
                throw new \Exception("NIY");
                break;
            }
            default : {
                // $controller->setContent('Not Found');
                throw new \Exception("NIY");
                break;
            }
        }
    }
}
