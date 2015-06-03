<?php

require_once '../vendor/autoload.php';

use Virgo\Tutorial\Router\SimpleRouter;

$requestURI = explode('/', $_SERVER['REQUEST_URI']);
var_dump($requestURI);
$router = new SimpleRouter();

$router->getRoute($requestURI);
