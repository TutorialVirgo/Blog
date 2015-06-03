<?php

namespace Virgo\Tutorial\Router;

class SimpleRouter
{
    /**
     * @param string $route
     */
    public function getRoute($route)
    {
        switch ($route) {
            case "/" : {
                echo 'Index';
                break;
            }
            case "/registration" : {
                echo 'Registration';
                break;
            }
            default : {
                echo 'Default';
                break;
            }
        }
    }
}
