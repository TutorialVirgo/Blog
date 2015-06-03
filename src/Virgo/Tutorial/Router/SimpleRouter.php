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
            case "registration" : {
                echo 'apad';
            }
            default : {
                echo 'def';
            }
        }
    }
}
